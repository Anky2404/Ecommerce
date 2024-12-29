<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('unit_price',10,2);
            $table->decimal('total_amount',10,2);
        

            //Foreign key constraint
           $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
           $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

           //Indexing perfomance
           $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('order_items');
    }
};
