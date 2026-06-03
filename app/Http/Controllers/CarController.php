<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(){
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create(){
        return view('cars.create');
    }

    public function edit($id){
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id){
        $car = Car::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required',
            'rent' => 'required|numeric',
            'pickup_address' => 'nullable|string',
            'description' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);   

        // 1. Gather surviving pre-existing images sent from the edit blade queue
        $imageCollection = $request->input('old_images', []);

        // 2. Find files that the user removed in the UI and delete them from physical storage
        $currentImagesInDb = $car->images ?? [];
        foreach ($currentImagesInDb as $savedPath) {
            if (!in_array($savedPath, $imageCollection)) {
                // The user removed this image, delete it from disk
                Storage::disk('public')->delete($savedPath);
            }
        }

        // 3. Process and append newly uploaded sequential files
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageCollection[] = $file->store('cars', 'public');
            }
        }

        // 4. Update the entire vehicle entry
        $car->update([
            'name' => $request->name,
            'model' => $request->model,
            'year' => $request->year,
            'rent' => $request->rent,
            'pickup_address' => $request->pickup_address,
            'description' => $request->description,
            'images' => $imageCollection, // Saves combined state arrays perfectly
        ]);

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'description' => 'required',
            'pickup_address' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rent' => 'required|numeric',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('cars', 'public');
            }
        }

        Car::create([
            'name' => $request->name,
            'model' => $request->model,
            'year' => $request->year,
            'description' => $request->description,
            'pickup_address' => $request->pickup_address,
            'images' => $imagePaths,
            'rent' => $request->rent,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car added successfully!');
    }

    public function updateStatus(Request $request, Car $car)
    {
        $request->validate([
            'status' => 'required|in:available,disabled'
        ]);

        $car->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Vehicle status updated.');
    }
}