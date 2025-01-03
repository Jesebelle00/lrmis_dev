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
        Schema::table('type_name', function (Blueprint $table) {
            $table->foreign(['cat_id'], 'type_name_ibfk_1')->references(['id'])->on('categories')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_name', function (Blueprint $table) {
            $table->dropForeign('type_name_ibfk_1');
        });
    }
};
