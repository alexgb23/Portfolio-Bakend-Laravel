<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return response()->json([
        "app" => config("app.name", "Portfolio Backend API"),
        "status" => "ok",
        "message" => "Portfolio Backend API online. Use /api for endpoints.",
        "environment" => app()->environment(),
        "timestamp" => now()->toIso8601String(),
    ]);
});

Route::get("/health", function () {
    return response()->json([
        "status" => "ok",
        "service" => "portfolio-backend",
        "timestamp" => now()->toIso8601String(),
    ]);
});
