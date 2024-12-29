<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('email',100)->unique();
            $table->string('phone',15);
            $table->date('dob');
            $table->boolean('is_active');
            $table->enum('role_type',['Admin','Customer','Staff','Seller']);
            $table->boolean('is_verified_account')->default(false);
            $table->string('password');
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
           

             // Indexing for performance 
             $table->index('email');  
            
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
    }
};
