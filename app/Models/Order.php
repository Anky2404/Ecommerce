<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //Define the table name
    protected $table = 'orders';

    //Define the fillable columns
    protected $fillable = ['user_id', 'address_id', 'order_status', 'total_amount', 'discount_amount', 'net_amount'];

    //Disable timestamps
    public $timestamps = false;


    // Relationship with the customer table
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
