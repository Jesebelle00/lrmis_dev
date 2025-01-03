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
        Schema::create('masterlist', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('acquisition_id')->nullable()->index('lr_id');
            $table->string('accession', 100)->nullable();
            $table->integer('encoder_id')->nullable()->index('masterlist_user_fk');
            $table->string('remarks', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterlist');
    }
};
