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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->foreignId('room_unit_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->string('phone');
            $table->text('address');
            $table->unique(['room_id', 'user_id']);
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
