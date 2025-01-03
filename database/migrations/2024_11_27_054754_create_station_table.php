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
        Schema::create('station', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('stationtype_id')->nullable()->index('stationtype_id');
            $table->integer('parent_station')->nullable()->index('parent_station');
            $table->timestamp('date_update')->nullable();
            $table->string('geoloc')->nullable();
            $table->integer('encoded_by')->nullable()->index('station_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('station');
    }
};
