<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

// Ruta principal de tu portafolio
Route::get('/', function () {
    return view('welcome');
});

// 👈 RUTA TEMPORAL PARA CONTROLAR LA BASE DE DATOS EN RENDER
Route::get('/check-db-status', function () {
    try {
        // Ejecuta las migraciones si es que falta alguna por aplicar
        Artisan::call('migrate', ['--force' => true]);
        $output = Artisan::output();

        // Obtiene el listado de todas las tablas creadas en Render Postgres
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");

        return response()->json([
            'status' => 'Conexion Exitosa con Render Postgres',
            'artisan_output' => trim($output) ?: 'No habia migraciones pendientes.',
            'tablas_existentes' => array_column($tables, 'table_name')
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
