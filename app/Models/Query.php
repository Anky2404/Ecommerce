<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
   // Define the table name
   protected $table = 'queries';
   // Define the fillable columns
   protected $fillable = [ 'sender_name', 'sender_email', 'sender_contact', 'subject', 'message',];

   //Disable timestamps
   public $timestamps = false;
}
