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
        Schema::create('loyalty_points', function (Blueprint $table) {
            //Primary id
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->integer('points');
            $table->enum('type',['Earned', 'Redeemed']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            //Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('purchase_id')->references('id')->on('orders')->cascadeOnDelete();

            //Indexing for performance
            $table->index('customer_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('loyalty_points');
    }
};
