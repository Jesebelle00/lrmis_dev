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
        Schema::table('user', function (Blueprint $table) {
            $table->foreign(['station_id'], 'user_ibfk_1')->references(['id'])->on('station')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['usertype_id'], 'user_ibfk_2')->references(['id'])->on('user_type')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['userstatus_id'], 'user_user_status_FK')->references(['id'])->on('user_status')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign('user_ibfk_1');
            $table->dropForeign('user_ibfk_2');
            $table->dropForeign('user_user_status_FK');
        });
    }
};
