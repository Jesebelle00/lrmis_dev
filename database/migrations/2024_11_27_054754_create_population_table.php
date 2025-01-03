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
        Schema::create('population', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('schoolyear_id')->nullable()->index('population_schoolyear_fk');
            $table->integer('beis_id')->nullable()->index('population_beis_fk');
            $table->integer('circular_class_grade_id')->nullable()->index('population_circular_class_grade_fk');
            $table->integer('population')->nullable();
            $table->timestamp('date_update')->nullable();
            $table->integer('updated_by')->nullable()->index('population_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population');
    }
};
