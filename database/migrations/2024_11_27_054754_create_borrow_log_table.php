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
        Schema::create('borrow_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('masterlist_id')->nullable()->index('masterlist_id');
            $table->integer('borrower_id')->nullable()->index('borrower_id');
            $table->date('date_borrowed')->nullable();
            $table->date('date_returned')->nullable();
            $table->integer('status_id')->nullable()->index('status_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_log');
    }
};
