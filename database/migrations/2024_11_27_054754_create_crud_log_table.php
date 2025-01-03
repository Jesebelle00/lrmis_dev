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
        Schema::create('crud_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('table_name')->nullable();
            $table->string('id_name')->nullable();
            $table->integer('id_value')->nullable();
            $table->integer('crud_type_id')->nullable()->index('crud_type_id');
            $table->dateTime('trans_date')->nullable();
            $table->integer('trans_by')->nullable()->index('trans_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crud_log');
    }
};
