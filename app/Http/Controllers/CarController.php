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
            'name' =>'required',
            'model' => 'required',
            'year' => 'required',
            'rent' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
        ]);   
         //update image if uploaded
        if($request->hasFile('image')){

            //delete previous image if exists
            if ($car->image && Storage::exists('public/' . $car->image)) {
            Storage::delete('public/' . $car->image);
        }
            $imagePath  = $request->file('image')->store('cars','public');
            $car->image = $imagePath;
        }
            $car->name = $request->name;
            $car->model = $request->model;
            $car->year = $request->year;
            $car->rent = $request->rent;
            $car->description = $request->description;

            $car->save();

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully!');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rent' => 'required|numeric',

        ]);
        $imagePath = $request->file('image')->store('cars', 'public');

        Car::create([
            'name' => $request->name,
            'model' => $request->model,
            'year' => $request->year,
            'description' => $request->description,
            'image' => $imagePath,
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
