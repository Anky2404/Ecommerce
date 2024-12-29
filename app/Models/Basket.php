<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
     // Define the table name
     protected $table = 'baskets';
     // Define the fillable columns
     protected $fillable = ['product_id', 'customer_id', 'quantity',];
 
 
     // Relationship with the product table (OrderItem belongs to Product)
     public function products()
     {
         return $this->belongsTo(Product::class, 'product_id', 'id');
     }

     //Disable timestamp
     public $timestamps = false;
}
