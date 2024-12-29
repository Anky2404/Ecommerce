<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    // Define the table name
    protected $table = 'product_images';

    // Define the fillable columns
    protected $fillable = ['product_id', 'image_url', 'is_main', 'is_active'];


    //Dsiable timestamps
    public $timestamps = false;

    // Define the relationship with the product table
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
