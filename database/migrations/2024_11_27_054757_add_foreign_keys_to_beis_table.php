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
        Schema::table('beis', function (Blueprint $table) {
            $table->foreign(['station_id'], 'beis_ibfk_1')->references(['id'])->on('station')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['schooltype_id'], 'beis_ibfk_2')->references(['id'])->on('school_type')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['circular_class_id'], 'beis_ibfk_3')->references(['id'])->on('circular_class')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['encoded_by'], 'beis_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beis', function (Blueprint $table) {
            $table->dropForeign('beis_ibfk_1');
            $table->dropForeign('beis_ibfk_2');
            $table->dropForeign('beis_ibfk_3');
            $table->dropForeign('beis_user_FK');
        });
    }
};
