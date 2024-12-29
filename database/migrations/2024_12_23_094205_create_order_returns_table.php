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
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('order_item_id');
            $table->text('return_reason');
            $table->enum('return_status',['Pending', 'Approved', 'Rejected', 'Completed']);
            $table->timestamp('request_date')->useCurrent();
            $table->decimal('refund_amount',10,2);
            $table->timestamp('return_date')->useCurrent()->useCurrentOnUpdate();

            //Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('order_item_id')->references('id')->on('order_items')->cascadeOnDelete();

            //Indexing for performance
            $table->index('order_id');
            $table->index('order_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('order_returns');
    }
};
