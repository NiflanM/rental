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
        ->whereIn('status', ['approved', 'pending'])
        ->get(['start_date', 'end_date']);
        return view('bookings.create', compact('car','bookedDates'));
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
        $exists = Booking::where('car_id', $car->id)

    ->whereIn('status', ['approved', 'pending'])

    ->where('start_date', '<=', $request->end_date)

    ->where('end_date', '>=', $request->start_date)

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

       return redirect()->route('bookings.index')->with('success','Booking Succesfully created');
    }

    public function edit(Booking $booking)
    {
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        $cars = Car::all();

        return view('bookings.edit', compact('booking', 'cars'));
    }
    public function update(Request $request, Booking $booking)
{
    if(auth()->user()->role !== 'admin'){
        abort(403);
    }

    $data = $request->validate([
        'car_id' => 'required|exists:cars,id',
        'customer_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:approved,pending,hold,rejected,cancelled',
        'notes' => 'nullable'
    ]);

    $car = Car::findOrFail($request->car_id);

    $exists = Booking::where('car_id', $car->id)

        ->where('id', '!=', $booking->id)

        ->whereIn('status', ['approved', 'pending'])

        ->where('start_date', '<=', $request->end_date)

        ->where('end_date', '>=', $request->start_date)

        ->exists();

    if($exists){
        return back()->withErrors([
            'booking' => 'Selected dates already booked.'
        ])->withInput();
    }

    $days = \Carbon\Carbon::parse($request->start_date)
        ->diffInDays($request->end_date) + 1;

    $total = $days * $car->rent;

    $booking->update([
        ...$data,
        'total_days' => $days,
        'total_price' => $total,
    ]);

    return redirect()
        ->route('bookings.index')
        ->with('success', 'Booking updated successfully.');
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
    public function cancel(Booking $booking)
{
    if(auth()->id() !== $booking->user_id){
        abort(403);
    }

    if($booking->status === 'cancelled'){
        return back()->with('error','Already cancelled');
    }

    $today = now()->startOfDay();

    $bookingDate = \Carbon\Carbon::parse(
        $booking->start_date
    )->startOfDay();

    if($today->gte($bookingDate)){
        return back()->with(
            'error',
            'Cannot cancel on booking date or after.'
        );
    }

    $booking->update([
        'status'=>'cancelled'
    ]);

    return back()->with(
        'success',
        'Booking cancelled successfully.'
    );
}
public function submitReview(Request $request, Booking $booking)
{
    // Ensure only the user who booked it can review it
    if (auth()->id() !== $booking->user_id) {
        abort(403);
    }

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'feedback' => 'nullable|string|max:1000'
    ]);

    $booking->update([
        'rating' => $request->rating,
        'feedback' => $request->feedback,
        'is_reviewed' => true
    ]);

    return back()->with('success', 'Thank you for your rating and feedback!');
}
}
