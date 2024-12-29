<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    // Automatically cast to Carbon instance
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',  
    ];
}
