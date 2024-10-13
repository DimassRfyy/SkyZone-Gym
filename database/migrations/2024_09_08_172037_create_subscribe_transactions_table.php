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
        Schema::create('subscribe_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('booking_trx_id');
            $table->string('proof');
            $table->unsignedBigInteger('total_amount');
            $table->unsignedBigInteger('duration');
            $table->date('started_at');
            $table->date('ended_at');
            $table->boolean('is_paid');
            $table->foreignId('subscribe_package_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribe_transactions');
    }
};
