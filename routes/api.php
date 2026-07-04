<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ContactMessageController;
USE App\Http\Controllers\Api\LaboratorioRealController;



// Públicas
Route::post('/login', [AuthController::class, 'login']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::get('/portfolio-home', [PortfolioController::class, 'getHomeData']);
Route::get('/portfolio-home/about', [PortfolioController::class, 'getAboutData']);

Route::post('/contact-messages', [ContactMessageController::class, 'store']);

// Laboratorio Real
Route::get('/laboratorios-reales', [LaboratorioRealController::class, 'index']);
Route::get('/laboratorios-reales/{slug}', [LaboratorioRealController::class, 'show']);




// Privadas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/verify-auth', function (Request $request) {
        return response()->json([
            'authenticated' => true,
            'user' => $request->user(),
        ], 200);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});
