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
        Schema::table('crud_log_detail', function (Blueprint $table) {
            $table->foreign(['crud_log_id'], 'crud_log_detail_ibfk_1')->references(['id'])->on('crud_log')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crud_log_detail', function (Blueprint $table) {
            $table->dropForeign('crud_log_detail_ibfk_1');
        });
    }
};
