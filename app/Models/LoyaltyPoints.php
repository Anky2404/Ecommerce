<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPoints extends Model
{
    
        //Define the table name
        protected $table = 'loyalty_points';

        //Definet the fillable columns
        protected $fillable = ['customer_id', 'purchase_id', 'points', 'type',];  

        //Disable timestamps
        public $timestamps = false;


     // Relationship with the customer table
     public function customers()
     {
         return $this->belongsTo(User::class, 'customer_id', 'id');
     }
}
