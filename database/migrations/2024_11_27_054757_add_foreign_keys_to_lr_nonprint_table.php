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
        Schema::table('lr_nonprint', function (Blueprint $table) {
            $table->foreign(['lr_id'], 'lr_nonprint_ibfk_1')->references(['id'])->on('lr')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['brand_id'], 'lr_nonprint_ibfk_2')->references(['id'])->on('brand')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['updated_by'], 'lr_nonprint_user_FK')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lr_nonprint', function (Blueprint $table) {
            $table->dropForeign('lr_nonprint_ibfk_1');
            $table->dropForeign('lr_nonprint_ibfk_2');
            $table->dropForeign('lr_nonprint_user_FK');
        });
    }
};
