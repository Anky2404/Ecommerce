<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPoints extends Model
{
    
        //Define the table name
        protected $table = 'loyalty_points';




     // Relationship with the customer table
     public function customers()
     {
         return $this->belongsTo(User::class, 'customer_id', 'id');
     }
}
