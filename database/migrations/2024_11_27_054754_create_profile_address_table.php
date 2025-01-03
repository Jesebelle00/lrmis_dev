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
        Schema::create('profile_address', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('profile_id')->nullable()->index('profile_id');
            $table->string('street', 75)->nullable();
            $table->string('zone', 75)->nullable();
            $table->integer('psgc_id')->nullable()->index('psgc_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_address');
    }
};
