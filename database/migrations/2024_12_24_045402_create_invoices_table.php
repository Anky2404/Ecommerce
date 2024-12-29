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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->timestamp('invoice_date')->useCurrent();
            $table->date('due_date');
            $table->decimal('sub_total',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('total_amount',10,2);
            $table->enum('status',['Paid', 'Unpaid', 'Partial', 'Cancelled']);
            $table->text('invoice_notes');

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
        Schema::dropIfExists('invoices');
    }
};
