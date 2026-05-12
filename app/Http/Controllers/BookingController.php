<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
class BookingController extends Controller
{
    public function index(){
        $user = auth()->user();

        if ($user->role === 'admin'){
            $bookings = Booking::with(['user', 'car'])->get();
        }
         else {
        $bookings = Booking::with(['car'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
    }

    return view('bookings.index', compact('bookings'));
    }

    public function create(Car $car){
        $bookedDates = Booking::where('car_id', $car->id)
         ->whereIn('status', ['approved', 'hold', 'pending'])
        ->get(['start_date', 'end_date']);
        return view('Bookings.create', compact('car','bookedDates'));
    }

    public function store(Request $request){
      $data =  $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'notes' => 'nullable'
        ]);

        $car = Car::findOrFail($request->car_id);
        //chks overlapping bookings for the same car
        $exists = Booking::where('car_id',$car->id)
            ->where('start_date','<=', $request->end_date)
            ->where('end_date','>=',$request->start_date)
            ->exists();

            if($exists){
                return back()->withErrors([
                'booking' => 'This car is already booked for the selected dates.'])->withInput();
            }


        $days = \Carbon\Carbon::parse($request->start_date)
            ->diffInDays($request->end_date) + 1;

        $total = $days * $car->rent;

        $booking = Booking::create([
            ...$data,
            'user_id' => auth()->id(),
            'total_days' => $days,
            'total_price' => $total,
            'status' => 'pending'
        ]);

       return redirect()->route('payhere.init', $booking->id);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // ONLY ADMIN
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected,hold'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Booking status updated.');
    }
}
