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
        Schema::create('user_type', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 75);
            $table->string('shortcode', 25);
            $table->integer('user_level_id')->nullable()->index('user_type_station_type_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_type');
    }
};
