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
        Schema::table('masterlist', function (Blueprint $table) {
            $table->foreign(['acquisition_id'], 'masterlist_ibfk_1')->references(['id'])->on('acquisition')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['encoder_id'], 'masterlist_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masterlist', function (Blueprint $table) {
            $table->dropForeign('masterlist_ibfk_1');
            $table->dropForeign('masterlist_user_FK');
        });
    }
};
