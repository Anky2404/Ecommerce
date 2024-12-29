<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define the table name
    protected $table = 'products';

    // Define the fillable columns
    protected $fillable = ['category_id', 'product_name', 'product_description', 'quantity', 'is_active', 'base_price', 'color', 'materials'];

    //Disable timestamps
    public $timestamps = false;



    // Define the relationship with the category table
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // Define the relationship with the product_images table
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Define the inverse relationship with the Basket table
    public function basket()
    {
        return $this->belongsTo(Basket::class); 
    }

     


    
}
