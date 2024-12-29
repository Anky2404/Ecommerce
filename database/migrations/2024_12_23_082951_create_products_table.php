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
        Schema::create('products', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('category_id');
           $table->string('product_name');
           $table->text('product_description');
           $table->integer('quantity');
           $table->boolean('is_active')->default(true);
           $table->decimal('base_price',10,2);
           $table->string('color',50);
           $table->string('materials',50);
           $table->timestamp('created_at')->useCurrent();
           $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

           //Foreign key
           $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

           //Indexing to performance
           $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};


