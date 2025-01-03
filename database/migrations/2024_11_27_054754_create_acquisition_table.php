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
        Schema::create('acquisition', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('library_id')->nullable()->index('acquisition_library_fk');
            $table->integer('lr_id')->nullable()->index('lr_id');
            $table->integer('src_id')->nullable()->index('src_id');
            $table->dateTime('date_acquired')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('cost', 10, 0)->nullable();
            $table->timestamp('date_encoded')->nullable();
            $table->integer('encoder_id')->nullable()->index('acquisition_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acquisition');
    }
};
