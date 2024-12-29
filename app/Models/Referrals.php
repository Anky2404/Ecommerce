<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{









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
