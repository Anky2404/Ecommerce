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
        Schema::create('user_details', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');  
            $table->unsignedBigInteger('user_id');  
            $table->enum('gender', ['Male', 'Female', 'Others']);  
            $table->string('profile_img', 255); 

            // Foreign key constraint
            $table->foreign('user_id')
                ->references('id')  
                ->on('users')
                ->onDelete('cascade');

            // Indexing user_id for performance
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
