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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->enum('payment_status',['Pending', 'Completed', 'Failed', 'Refunded']);
            $table->enum('payment_method',['Credit Card', 'Paypal', 'Bank Transfer']);
            $table->decimal('payment_amount',10,2);
            $table->timestamp('payment_date')->useCurrent();

            //Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();

            //Indexing for performance
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
