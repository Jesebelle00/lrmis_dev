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
        Schema::create('status_update', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('masterlist_id')->nullable()->index('masterlist_id');
            $table->integer('status_id')->nullable()->index('status_id');
            $table->date('date_update')->nullable();
            $table->integer('remarks_id')->nullable()->index('remarks_id');
            $table->integer('updatedby')->nullable()->index('status_update_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_update');
    }
};
