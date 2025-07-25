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
        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('customer')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('room_unit_id')->constrained()->after('user_id');
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        $table->text('notes')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
