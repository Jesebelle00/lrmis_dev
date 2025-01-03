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
        Schema::table('circular_class_grade', function (Blueprint $table) {
            $table->foreign(['circular_class_id'], 'circular_class_grade_ibfk_1')->references(['id'])->on('circular_class')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['gradelevel_id'], 'circular_class_grade_ibfk_2')->references(['id'])->on('grade_level')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('circular_class_grade', function (Blueprint $table) {
            $table->dropForeign('circular_class_grade_ibfk_1');
            $table->dropForeign('circular_class_grade_ibfk_2');
        });
    }
};
