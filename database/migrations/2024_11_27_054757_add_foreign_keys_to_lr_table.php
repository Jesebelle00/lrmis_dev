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
        Schema::table('lr', function (Blueprint $table) {
            $table->foreign(['type_id'], 'lr_ibfk_1')->references(['id'])->on('type_name')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['title_id'], 'lr_title_FK')->references(['id'])->on('title')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lr', function (Blueprint $table) {
            $table->dropForeign('lr_ibfk_1');
            $table->dropForeign('lr_title_FK');
        });
    }
};
