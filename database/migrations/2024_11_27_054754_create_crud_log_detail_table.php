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
        Schema::create('crud_log_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('crud_log_id')->nullable()->index('crud_log_id');
            $table->string('column_name')->nullable();
            $table->string('change_from')->nullable();
            $table->string('change_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crud_log_detail');
    }
};
