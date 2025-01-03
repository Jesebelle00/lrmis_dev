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
        Schema::create('station_contact', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('station_id')->nullable()->index('station_id');
            $table->integer('contacttype_id')->nullable()->index('contacttype_id');
            $table->string('value');
            $table->timestamp('date_update')->nullable();
            $table->integer('encoded_by')->nullable()->index('station_contact_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('station_contact');
    }
};
