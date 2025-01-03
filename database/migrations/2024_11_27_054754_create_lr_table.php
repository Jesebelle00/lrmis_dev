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
        Schema::create('lr', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('type_id')->nullable()->index('type_id');
            $table->integer('title_id')->nullable()->index('lr_title_fk');
            $table->timestamp('date_update')->nullable();
            $table->integer('encoder_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lr');
    }
};
