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
        Schema::create('circular_class_grade', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('gradelevel_id')->nullable()->index('gradelevel_id');
            $table->integer('circular_class_id')->nullable()->index('circular_class_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circular_class_grade');
    }
};
