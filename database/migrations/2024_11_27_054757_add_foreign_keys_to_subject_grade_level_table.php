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
        Schema::table('subject_grade_level', function (Blueprint $table) {
            $table->foreign(['subject_id'], 'subject_grade_level_ibfk_1')->references(['id'])->on('subject')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['gradelevel_id'], 'subject_grade_level_ibfk_2')->references(['id'])->on('grade_level')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subject_grade_level', function (Blueprint $table) {
            $table->dropForeign('subject_grade_level_ibfk_1');
            $table->dropForeign('subject_grade_level_ibfk_2');
        });
    }
};
