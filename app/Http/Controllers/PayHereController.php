<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PayHereController extends Controller
{
    // public function pay($bookingId)
    // {
    //     $booking = Booking::with('car')->findOrFail($bookingId);

    //     $merchant_id = env('PAYHERE_MERCHANT_ID');

    //     $order_id = $booking->id;
    //     $amount = $booking->total_price;

    //     $currency = "LKR";

    //     $hash = strtoupper(
    //         md5(
    //             $merchant_id .
    //             $order_id .
    //             number_format($amount, 2, '.', '') .
    //             $currency .
    //             strtoupper(md5(env('PAYHERE_SECRET')))
    //         )
    //     );

    //     return view('payhere.checkout', compact(
    //         'booking',
    //         'merchant_id',
    //         'hash',
    //         'amount',
    //         'currency',
    //         'order_id'
    //     ));
    // }

    public function callback(Request $request)
    {
        $order_id = $request->order_id;

        $booking = Booking::find($order_id);

        if($booking){
            $booking->update([
                'payment_status' => 'paid'
            ]);
        }

        return response('OK', 200);
    }

    public function success()
    {
        return redirect()->route('bookings.index')
            ->with('success', 'Payment Successful!');
    }

    public function init(Booking $booking)
{
    $merchant_id = env('PAYHERE_MERCHANT_ID');
    $merchant_secret = env('PAYHERE_SECRET');

    $order_id = $booking->id;

    // IMPORTANT: FIX AMOUNT FORMAT
    $amount = number_format($booking->total_price, 2, '.', '');

    $currency = "LKR";

    // FIXED HASH (VERY IMPORTANT)
    $hash = strtoupper(
        md5(
            $merchant_id .
            $order_id .
            $amount .
            $currency .
            strtoupper(md5($merchant_secret))
        )
    );

    return view('payhere.checkout', compact(
        'booking',
        'merchant_id',
        'order_id',
        'amount',
        'currency',
        'hash'
    ));
}
     public function notify(Request $request)
    {
        $merchant_secret = "MjIwMjc5MzY0ODE5NDgwNDMwMzkyNTk3NDczMTg0OTU1OTEzNDAz";

        $local_md5sig = strtoupper(
            md5(
                $request->merchant_id .
                $request->order_id .
                $request->payhere_amount .
                $request->payhere_currency .
                $request->status_code .
                strtoupper(md5($merchant_secret))
            )
        );

        if ($local_md5sig === $request->md5sig && $request->status_code == 2) {

            $booking = Booking::find($request->order_id);

            if ($booking) {
                $booking->status = "approved";
                $booking->save();
            }
        }

        return response()->json(['status' => 'ok']);
    }

   
}