<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
     // Define the table name
     protected $table = 'user_details';

     //Define the fillable columns
     protected $fillable=['user_id', 'gender', 'profile_img'];

     //Disable timestamp
    public $timestamps = false;
}
