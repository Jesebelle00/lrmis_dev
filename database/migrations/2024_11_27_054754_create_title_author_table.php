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
        Schema::create('title_author', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('title_id')->nullable()->index('title_author_fk');
            $table->integer('author_id')->nullable()->index('title_author_title_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('title_author');
    }
};
