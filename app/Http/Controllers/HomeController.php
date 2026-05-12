<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
class HomeController extends Controller
{
      public function welcome()
{
    $cars = Car::latest()->take(6)->get();
    return view('welcome', compact('cars'));
}
}
