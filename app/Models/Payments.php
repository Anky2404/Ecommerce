<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    







    // Relationship with the customer table
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
