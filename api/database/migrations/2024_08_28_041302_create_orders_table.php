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
        if (!Schema::hasTable('orders')) {

            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('customer_name');
                $table->string('customer_phone');
                $table->string('customer_email');
                $table->string('customer_cin');  // CIN có thể là "Customer Identification Number"
                $table->date('customer_dob');
                $table->integer('total');
                $table->date('start_date');
                $table->date('end_date');
                $table->foreignId('payment_id')->constrained('payments');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
