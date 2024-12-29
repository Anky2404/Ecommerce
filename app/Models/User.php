<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define the table name
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'dob',
        'is_active',
        'role_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //disable timestamps
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // No need for 'password' => 'hashed' here, the mutator takes care of it
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the user's password and hash it before saving.
     *
     * @param  string  $value
     * @return void
     */
   

    // Relationship with the customer table
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Define the relationship with the product table
    public function details()
    {
        return $this->hasMany(UserDetails::class);
    }
}
