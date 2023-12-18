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
        Schema::table('flights', function (Blueprint $table) {
            $table->foreign('origin_airport_id')->references('id')->on('airports');
            $table->foreign('destination_airport_id')->references('id')->on('airports');

            $table->foreign('airplane_id')->references('id')->on('airplanes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dropForeign(['origin_airport_id']);
            $table->dropForeign(['destination_airport_id']);
            $table->dropForeign(['airplane_id']);
        });
    }
};
