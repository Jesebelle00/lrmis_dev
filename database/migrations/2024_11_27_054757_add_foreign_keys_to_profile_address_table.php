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
        Schema::table('profile_address', function (Blueprint $table) {
            $table->foreign(['profile_id'], 'profile_address_ibfk_1')->references(['id'])->on('profile')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['psgc_id'], 'profile_address_ibfk_2')->references(['id'])->on('psgc')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_address', function (Blueprint $table) {
            $table->dropForeign('profile_address_ibfk_1');
            $table->dropForeign('profile_address_ibfk_2');
        });
    }
};
