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
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamp('created_at')->useCurrent();

           // Foreign key constraint
           $table->foreign('customer_id')->references('id')->on('users')->cascadeOnDelete();
           $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        
            //Indexing to performance
            $table->index('customer_id');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('wishlist');
    }
};
