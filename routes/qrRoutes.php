<?php

use App\Http\Controllers\Qr\ImportExcelController;
use App\Http\Controllers\Qr\QrController;
use Illuminate\Support\Facades\Route;


Route::get('lr', [QrController::class, 'index'])
        ->name('lr.index');

// routes/web.php
Route::get('lr/{id}', [QrController::class, 'show'])->name('lr.show');


