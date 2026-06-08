<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
{
    // 1. Start with cars that are explicitly marked as available
    $query = Car::where('status', 'available');

    // 2. Filter strictly by location if provided
    if ($request->filled('location')) {
        $query->where('pickup_address', 'LIKE', '%' . $request->location . '%');
    }

    // 3. Exclude cars that have an overlapping booking during these dates
    if ($request->filled('pickup_date') && $request->filled('dropoff_date')) {
        $pickupDate = $request->pickup_date;
        $dropoffDate = $request->dropoff_date;

        $query->whereNotExists(function ($subQuery) use ($pickupDate, $dropoffDate) {
            $subQuery->from('bookings')
                ->whereRaw('bookings.car_id = cars.id')
                // Only consider active reservation blocks (ignore cancelled/rejected ones)
                ->whereIn('bookings.status', ['approved', 'pending']) 
                ->where(function ($q) use ($pickupDate, $dropoffDate) {
                    // FIXED: Changed pickup_date/dropoff_date to start_date/end_date to match your table schema
                    $q->whereBetween('start_date', [$pickupDate, $dropoffDate])
                      ->orWhereBetween('end_date', [$pickupDate, $dropoffDate])
                      ->orWhere(function ($inner) use ($pickupDate, $dropoffDate) {
                          $inner->where('start_date', '<=', $pickupDate)
                                ->where('end_date', '>=', $dropoffDate);
                      });
                });
        });
    }

    // 4. Retrieve your clean, filtered fleet
    $cars = $query->get();

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
    public function destroy($id)
    {
        // 1. Find the car or throw a 404 error if it doesn't exist
        $car = Car::findOrFail($id);

        // 2. Delete any associated images from physical storage if they exist
        if (!empty($car->images)) {
            foreach ($car->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        // 3. Delete the car record from the database
        $car->delete();

        // 4. Redirect back to the index page with a success message
        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully!');
    }
}