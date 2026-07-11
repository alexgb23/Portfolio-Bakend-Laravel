<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'backend-home')->name('backend.home');

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'portfolio-backend',
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('backend.health');
