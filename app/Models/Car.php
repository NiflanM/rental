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
        'image',
        'rent',
        'status',
    ];
}
