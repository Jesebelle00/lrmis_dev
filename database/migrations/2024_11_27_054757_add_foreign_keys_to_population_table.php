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
        Schema::table('population', function (Blueprint $table) {
            $table->foreign(['beis_id'], 'population_beis_FK')->references(['id'])->on('beis')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['circular_class_grade_id'], 'population_circular_class_grade_FK')->references(['id'])->on('circular_class_grade')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['schoolyear_id'], 'population_schoolyear_FK')->references(['id'])->on('school_year')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['updated_by'], 'population_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('population', function (Blueprint $table) {
            $table->dropForeign('population_beis_FK');
            $table->dropForeign('population_circular_class_grade_FK');
            $table->dropForeign('population_schoolyear_FK');
            $table->dropForeign('population_user_FK');
        });
    }
};
