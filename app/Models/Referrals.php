<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{

//Define the table name
protected $table = 'referrals';

//Define the fillable columns
protected $fillable = ['referred_by', 'referred_to', 'referral_code'];


//Disable timestamps
public $timestamps = false;

  // Relationship with the customer table
  public function RefferBy()
  {
      return $this->belongsTo(User::class, 'referred_by', 'id');
  }

    // Relationship with the customer table
    public function RefferTo()
    {
        return $this->belongsTo(User::class, 'referred_to', 'id');
    }




}
