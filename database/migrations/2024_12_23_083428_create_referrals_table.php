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
        Schema::create('referrals', function (Blueprint $table) {
            // Primary key
            $table->id(); 
            $table->unsignedBigInteger('referred_by'); 
            $table->unsignedBigInteger('referred_to'); 
            $table->string('referral_code')->unique();
            $table->decimal('reward_earned', 10, 2)->default(0); 
            $table->timestamp('referred_at')->useCurrent();
            
            // Foreign key constraints
            $table->foreign('referred_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('referred_to')->references('id')->on('users')->cascadeOnDelete();
            
            //Indexing to performance
            $table->index('referred_by');
            $table->index('referred_to');

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
