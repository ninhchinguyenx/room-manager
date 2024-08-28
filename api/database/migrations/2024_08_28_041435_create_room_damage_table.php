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
        if (!Schema::hasTable('room_damage')) {

            Schema::create('room_damage', function (Blueprint $table) {
                $table->id();
                $table->integer('quantity');
                $table->integer('price');
                $table->string('reason');
                $table->text('description')->nullable();
                $table->foreignId('device_id')->constrained('devices');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_damage');
    }
};
