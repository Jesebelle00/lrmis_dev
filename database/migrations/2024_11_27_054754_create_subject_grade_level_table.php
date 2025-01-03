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
        Schema::create('subject_grade_level', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('subject_id')->nullable()->index('subject_id');
            $table->integer('gradelevel_id')->nullable()->index('gradelevel_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_grade_level');
    }
};
