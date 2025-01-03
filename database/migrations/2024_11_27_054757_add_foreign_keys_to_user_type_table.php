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
        Schema::table('user_type', function (Blueprint $table) {
            $table->foreign(['user_level_id'], 'user_type_station_type_FK')->references(['id'])->on('station_type')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_type', function (Blueprint $table) {
            $table->dropForeign('user_type_station_type_FK');
        });
    }
};
