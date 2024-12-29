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
        Schema::create('products_inventory', function (Blueprint $table) {
            //Primary id
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->timestamp('last_checked')->useCurrent();
            $table->string('shelf_number');
            $table->unsignedBigInteger('last_updated_by');
            $table->boolean('is_active')->default(true);

            // Foreign Constraints
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('last_updated_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_inventory'); 
    }
};
