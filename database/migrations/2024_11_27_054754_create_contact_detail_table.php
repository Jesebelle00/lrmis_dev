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
        Schema::create('contact_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('contacttype_id')->nullable()->index('contacttype_id');
            $table->string('value')->nullable();
            $table->integer('profile_id')->nullable()->index('person_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_detail');
    }
};
