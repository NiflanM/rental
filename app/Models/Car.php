<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'model',
        'year',
        'description',
        'images',
        'rent',
        'pickup_address',
        'status',
    ];
    protected $casts = [
    'images' => 'array',
];
}
