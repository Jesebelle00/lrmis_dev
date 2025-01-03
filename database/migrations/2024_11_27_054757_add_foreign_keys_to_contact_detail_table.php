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
        Schema::table('contact_detail', function (Blueprint $table) {
            $table->foreign(['profile_id'], 'contact_detail_ibfk_1')->references(['id'])->on('profile')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['contacttype_id'], 'contact_detail_ibfk_2')->references(['id'])->on('contact_type')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_detail', function (Blueprint $table) {
            $table->dropForeign('contact_detail_ibfk_1');
            $table->dropForeign('contact_detail_ibfk_2');
        });
    }
};
