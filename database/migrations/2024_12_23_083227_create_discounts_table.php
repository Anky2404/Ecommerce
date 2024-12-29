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
        Schema::create('discounts', function (Blueprint $table) {
            // Primary key
            $table->id();
            $table->string('code', 100);
            $table->enum('type', ['percentage', 'fixed']);
            $table->decimal('value', 10, 2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('min_order_value', 10, 2)->default(0);
            $table->integer('usage_limit')->default(0);
            $table->integer('used_count')->default(0);
            $table->enum('status', ['Active', 'Inactive', 'Expired'])->default('active');
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
