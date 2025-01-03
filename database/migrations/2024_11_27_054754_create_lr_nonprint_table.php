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
        Schema::create('lr_nonprint', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('lr_id')->nullable()->index('lr_id');
            $table->integer('brand_id')->nullable()->index('brand_id');
            $table->integer('code')->nullable();
            $table->string('url')->nullable();
            $table->integer('size')->nullable();
            $table->string('model', 100)->nullable();
            $table->timestamp('date_updated')->nullable();
            $table->integer('updated_by')->nullable()->index('lr_nonprint_user_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lr_nonprint');
    }
};
