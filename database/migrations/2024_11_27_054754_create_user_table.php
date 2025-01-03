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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->integer('station_id')->nullable()->index('station_id');
            $table->integer('usertype_id')->nullable()->index('usertype_id');
            $table->date('date_created')->nullable();
            $table->integer('userstatus_id')->nullable()->index('user_user_status_fk');
            $table->timestamp('date_update')->nullable();
            $table->integer('profile_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
