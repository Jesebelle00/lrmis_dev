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
        Schema::create('type_name', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cat_id')->nullable()->index('cat_id');
            $table->string('type_name', 75)->nullable();
            $table->string('shortcode', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_name');
    }
};
