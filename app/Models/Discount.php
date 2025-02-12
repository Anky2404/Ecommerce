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

    //Define the fillable columns
    protected $fillable=['code', 'type', 'value', 'start_date', 'end_date', 'min_order_value', 'usage_limit', 'used_count', 'status', 'description',];
}
