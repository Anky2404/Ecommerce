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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('fullname',100);
            $table->string('email_address',100);
            $table->string('phone_number',15);
            $table->enum('address_type',['customer_address','seller_address']);
            $table->string('suburb');
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('postal_code',8);
            $table->boolean('is_active')->default(true);
            $table->enum('location_type',['Home','Office','Others']);
            $table->string('landmark',255);
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            //Foreign constraints
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('addresses');
    }
};
