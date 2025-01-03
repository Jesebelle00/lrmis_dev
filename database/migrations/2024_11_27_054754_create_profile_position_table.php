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
        Schema::create('profile_position', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('profile_id')->nullable()->index('profile_id');
            $table->integer('position_id')->nullable()->index('position_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_position');
    }
};
