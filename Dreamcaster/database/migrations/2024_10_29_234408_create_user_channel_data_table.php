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
        Schema::create('user_channel_data', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('channelId');
            $table->integer('points');
            $table->timestamp('followDate');
            $table->timestamp('subscriptionDate')->nullable();
            $table->integer('subscriptionLevel')->nullable();
            $table->integer('subscriptionStreak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_channel_data');
    }
};
