<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Define the table name
    protected $table = 'addresses';
    // Define the fillable columns
    protected $fillable = [ 'user_id', 'fullname', 'email_address', 'phone_number', 'address_type', 'suburb', 'city', 'state', 'country', 'postal_code', 'location_type', 'landmark',];

    //Disable timestamps
    public $timestamps = false;
   
}
