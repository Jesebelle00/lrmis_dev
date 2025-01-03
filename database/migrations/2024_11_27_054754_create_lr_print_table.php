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
        Schema::create('lr_print', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('lr_id')->nullable()->index('lr_id');
            $table->integer('publisher_id')->nullable()->index('publisher_id');
            $table->integer('volume')->nullable();
            $table->integer('copyrightyear')->nullable();
            $table->integer('pages')->nullable();
            $table->string('isbn')->nullable();
            $table->timestamp('date_update')->nullable();
            $table->integer('updated_by')->nullable()->index('lr_print_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lr_print');
    }
};
