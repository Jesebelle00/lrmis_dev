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
        Schema::table('crud_log', function (Blueprint $table) {
            $table->foreign(['crud_type_id'], 'crud_log_ibfk_1')->references(['id'])->on('crud_type')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['trans_by'], 'crud_log_ibfk_2')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crud_log', function (Blueprint $table) {
            $table->dropForeign('crud_log_ibfk_1');
            $table->dropForeign('crud_log_ibfk_2');
        });
    }
};
