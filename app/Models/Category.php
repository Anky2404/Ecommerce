<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    // Define the table name
    protected $table = 'categories';
    // Define the fillable columns
    protected $fillable = ['category_name', 'category_description', 'category_img', 'is_active',];


    // Define the relationship with the product table
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
