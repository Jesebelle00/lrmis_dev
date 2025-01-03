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
        Schema::table('station_head', function (Blueprint $table) {
            $table->foreign(['profile_id'], 'station_head_profile_FK')->references(['id'])->on('profile')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['station_id'], 'station_head_station_FK')->references(['id'])->on('station')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('station_head', function (Blueprint $table) {
            $table->dropForeign('station_head_profile_FK');
            $table->dropForeign('station_head_station_FK');
        });
    }
};
