<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\MetricController;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServerController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\LaboratorioController;
use App\Http\Controllers\Api\LaboratoryHomeController;
use App\Http\Controllers\Api\HomeAssistantInstanceController;
use App\Http\Controllers\Api\LocalAiSetupController;
use App\Http\Controllers\Api\AiStudyCaseController;
use App\Http\Controllers\Api\ClusterController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\LabCapabilityController;
use App\Http\Controllers\Api\ResearchSourceController;



// Públicas
Route::post('/login', [AuthController::class, 'login']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::get('/nodes', [NodeController::class, 'index']);
Route::get('/nodes/{id}', [NodeController::class, 'show']);

Route::get('/servers', [ServerController::class, 'index']);
Route::get('/servers/{id}', [ServerController::class, 'show']);

Route::get('/metrics', [MetricController::class, 'index']);
Route::get('/metrics/{id}', [MetricController::class, 'show']);

Route::get('/portfolio-home', [PortfolioController::class, 'getHomeData']);

Route::get('/laboratorio/home', [LaboratoryHomeController::class, 'index']);
Route::get('/laboratorio', [LaboratorioController::class, 'index']);
Route::get('/laboratorio/{id}', [LaboratorioController::class, 'show']);

Route::get('/home-assistant', [HomeAssistantInstanceController::class, 'index']);
Route::get('/home-assistant/{id}', [HomeAssistantInstanceController::class, 'show']);

Route::get('/local-ai-setups', [LocalAiSetupController::class, 'index']);
Route::get('/local-ai-setups/{id}', [LocalAiSetupController::class, 'show']);

Route::get('/ai-study-cases', [AiStudyCaseController::class, 'index']);
Route::get('/ai-study-cases/{id}', [AiStudyCaseController::class, 'show']);

Route::get('/clusters', [ClusterController::class, 'index']);
Route::get('/clusters/{id}', [ClusterController::class, 'show']);

Route::get('/lab-capabilities', [LabCapabilityController::class, 'index']);
Route::get('/lab-capabilities/{id}', [LabCapabilityController::class, 'show']);

Route::get('/research-sources', [ResearchSourceController::class, 'index']);
Route::get('/research-sources/{id}', [ResearchSourceController::class, 'show']);

Route::post('/contact-messages', [ContactMessageController::class, 'store']);


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
