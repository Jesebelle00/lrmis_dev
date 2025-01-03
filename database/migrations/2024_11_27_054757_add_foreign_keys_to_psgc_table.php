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
        Schema::table('psgc', function (Blueprint $table) {
            $table->foreign(['geolevel_id'], 'psgc_ibfk_1')->references(['id'])->on('geo_level')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id'], 'psgc_psgc_FK')->references(['id'])->on('psgc')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('psgc', function (Blueprint $table) {
            $table->dropForeign('psgc_ibfk_1');
            $table->dropForeign('psgc_psgc_FK');
        });
    }
};
