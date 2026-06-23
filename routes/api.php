<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\MetricController;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServerController;

// Públicas
Route::post('/login', [AuthController::class, 'login']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/nodes', [NodeController::class, 'index']);
Route::get('/servers', [ServerController::class, 'index']);
Route::get('/metrics', [MetricController::class, 'index']);

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
