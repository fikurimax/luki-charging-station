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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_used')->default(false);
            $table->dateTime('started_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('payment_total')->nullable();
            $table->text('payment_token')->nullable();
            $table->dateTime('payment_expiration')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
