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
        Schema::create('beis', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('station_id')->nullable()->index('station_id');
            $table->string('beis_id', 50)->nullable();
            $table->integer('schooltype_id')->nullable()->index('schooltype_id');
            $table->date('date_established')->nullable();
            $table->integer('circular_class_id')->nullable()->index('circular_class_id');
            $table->timestamp('date_update')->nullable();
            $table->integer('encoded_by')->nullable()->index('beis_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beis');
    }
};
