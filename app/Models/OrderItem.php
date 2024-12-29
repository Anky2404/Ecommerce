<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Define the table name
    protected $table = 'order_items';

    // Define the fillable columns
    protected $fillable = ['order_id', 'product_id', 'quantity', 'total_price'];

    // Disable timestamps
    public $timestamps = false;

    // Relationship with the product table
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
