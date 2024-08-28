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
        if (!Schema::hasTable('order_items')) {

            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->string('room_name');
                $table->integer('room_price');
                $table->string('room_category');
                $table->integer('total');
                $table->date('start_date');
                $table->date('end_date');
                $table->foreignId('room_service_id')->constrained('room_services');
                $table->foreignId('room_device_id')->constrained('room_devices');
                $table->foreignId('room_damage_id')->nullable()->constrained('room_damage');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
