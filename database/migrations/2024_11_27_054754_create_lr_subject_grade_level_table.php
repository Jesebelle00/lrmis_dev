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
        Schema::create('lr_subject_grade_level', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('lr_id')->nullable();
            $table->integer('subjectgradelevel_id')->nullable()->index('subjectgradelevel_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lr_subject_grade_level');
    }
};
