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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flight_class_id');
            $table->unsignedBigInteger('flight_id');
            $table->string('passenger_name');
            $table->string('passenger_cpf');
            $table->string('passenger_birthday');
            $table->string('total_price');
            $table->string('number');
            $table->unsignedBigInteger('purchase_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
