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
        Schema::table('lr_print', function (Blueprint $table) {
            $table->foreign(['lr_id'], 'lr_print_ibfk_1')->references(['id'])->on('lr')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['publisher_id'], 'lr_print_ibfk_2')->references(['id'])->on('publisher')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['updated_by'], 'lr_print_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lr_print', function (Blueprint $table) {
            $table->dropForeign('lr_print_ibfk_1');
            $table->dropForeign('lr_print_ibfk_2');
            $table->dropForeign('lr_print_user_FK');
        });
    }
};
