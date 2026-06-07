<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;
class Booking extends Model

{
protected $fillable=[

'user_id',

'car_id',

'customer_name',

'email',

'phone',

'start_date',

'end_date',

'total_days',

'total_price',

'notes',

'status',

'order_id',

'payment_id',

'payment_completed',

'rating',

'feedback',

'is_reviewed'

];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
