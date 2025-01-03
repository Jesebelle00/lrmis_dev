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
        Schema::table('acquisition', function (Blueprint $table) {
            $table->foreign(['lr_id'], 'acquisition_ibfk_1')->references(['id'])->on('lr')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['src_id'], 'acquisition_ibfk_3')->references(['id'])->on('source')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['library_id'], 'acquisition_library_FK')->references(['id'])->on('library')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['encoder_id'], 'acquisition_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acquisition', function (Blueprint $table) {
            $table->dropForeign('acquisition_ibfk_1');
            $table->dropForeign('acquisition_ibfk_3');
            $table->dropForeign('acquisition_library_FK');
            $table->dropForeign('acquisition_user_FK');
        });
    }
};
