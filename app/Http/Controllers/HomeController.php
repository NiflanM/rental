<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    /**
     * Display the dynamic landing marketplace page.
     */
    public function index()
    {
        // 1. Fetch cars for your arrival slider exhibit card items
        $cars = Car::all();

        // 2. Fetch only unique, valid addresses from your table to populate the dropdown filter
        $locations = Car::whereNotNull('pickup_address')
                        ->where('pickup_address', '!=', '')
                        ->distinct()
                        ->pluck('pickup_address');

        // Pass both variables cleanly to your welcome blade template
        return view('welcome', compact('cars', 'locations'));
    }
}