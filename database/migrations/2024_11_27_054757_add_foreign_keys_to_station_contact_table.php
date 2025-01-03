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
        Schema::table('station_contact', function (Blueprint $table) {
            $table->foreign(['station_id'], 'station_contact_ibfk_1')->references(['id'])->on('station')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['contacttype_id'], 'station_contact_ibfk_2')->references(['id'])->on('contact_type')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['encoded_by'], 'station_contact_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('station_contact', function (Blueprint $table) {
            $table->dropForeign('station_contact_ibfk_1');
            $table->dropForeign('station_contact_ibfk_2');
            $table->dropForeign('station_contact_user_FK');
        });
    }
};
