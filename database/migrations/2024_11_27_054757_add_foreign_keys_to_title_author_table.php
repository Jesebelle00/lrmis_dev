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
        Schema::table('title_author', function (Blueprint $table) {
            $table->foreign(['title_id'], 'title_author_FK')->references(['id'])->on('title')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['author_id'], 'title_author_ibfk_1')->references(['id'])->on('author')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('title_author', function (Blueprint $table) {
            $table->dropForeign('title_author_FK');
            $table->dropForeign('title_author_ibfk_1');
        });
    }
};
