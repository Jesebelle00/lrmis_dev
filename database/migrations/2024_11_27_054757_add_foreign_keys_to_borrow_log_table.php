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
        Schema::table('borrow_log', function (Blueprint $table) {
            $table->foreign(['masterlist_id'], 'borrow_log_ibfk_1')->references(['id'])->on('masterlist')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['status_id'], 'borrow_log_ibfk_2')->references(['id'])->on('status')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['borrower_id'], 'borrow_log_ibfk_3')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_log', function (Blueprint $table) {
            $table->dropForeign('borrow_log_ibfk_1');
            $table->dropForeign('borrow_log_ibfk_2');
            $table->dropForeign('borrow_log_ibfk_3');
        });
    }
};
