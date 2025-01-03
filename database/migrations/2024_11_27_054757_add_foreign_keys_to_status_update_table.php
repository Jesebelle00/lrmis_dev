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
        Schema::table('status_update', function (Blueprint $table) {
            $table->foreign(['masterlist_id'], 'status_update_ibfk_1')->references(['id'])->on('masterlist')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['status_id'], 'status_update_ibfk_2')->references(['id'])->on('status')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['remarks_id'], 'status_update_ibfk_3')->references(['id'])->on('remarks')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['updatedby'], 'status_update_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_update', function (Blueprint $table) {
            $table->dropForeign('status_update_ibfk_1');
            $table->dropForeign('status_update_ibfk_2');
            $table->dropForeign('status_update_ibfk_3');
            $table->dropForeign('status_update_user_FK');
        });
    }
};
