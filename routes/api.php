<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\LaboratorioRealController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Públicas
Route::post('/login', [AuthController::class, 'login']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

Route::get('/portfolio-home', [PortfolioController::class, 'getHomeData']);
Route::get('/portfolio-home/about', [PortfolioController::class, 'getAboutData']);

Route::post('/contact-messages', [ContactMessageController::class, 'store']);

Route::get('/laboratorios-reales/home', [LaboratorioRealController::class, 'home']);
Route::get('/laboratorios-reales/home-lab', [LaboratorioRealController::class, 'homeLab']);
Route::get('/laboratorios-reales', [LaboratorioRealController::class, 'index']);
Route::get('/laboratorios-reales/{slug}', [LaboratorioRealController::class, 'show']);

// Privadas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/verify-auth', function (Request $request) {
        return response()->json([
            'authenticated' => true,
            'user' => new UserResource($request->user()),
        ]);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});
