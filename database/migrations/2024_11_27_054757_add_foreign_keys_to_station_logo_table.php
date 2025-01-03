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
        Schema::table('station_logo', function (Blueprint $table) {
            $table->foreign(['station_id'], 'station_logo_station_FK')->references(['id'])->on('station')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['encoded_by'], 'station_logo_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('station_logo', function (Blueprint $table) {
            $table->dropForeign('station_logo_station_FK');
            $table->dropForeign('station_logo_user_FK');
        });
    }
};
