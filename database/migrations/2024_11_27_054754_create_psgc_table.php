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
        Schema::create('psgc', function (Blueprint $table) {
            $table->integer('id')->index('idx_psgc_id');
            $table->string('digitcode', 15)->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('geolevel_id')->nullable()->index('geolevel_id');
            $table->integer('parent_psgc')->nullable()->index('parent_psgc');

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psgc');
    }
};
