<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    */

    // Rutas protegidas por el filtro de CORS
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Métodos HTTP permitidos para interactuar con tus controladores
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

    // 🔒 Control de Origen: Solo tu sitio oficial y tu entorno local tienen acceso
    'allowed_origins' => [
        'https://portfolioalexsys.netlify.app',
        'http://localhost:5173',
    ],

    'allowed_origins_patterns' => [],

    // Cabeceras permitidas explícitamente para peticiones seguras
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept'],

    'exposed_headers' => [],

    // Cachea la respuesta del Preflight (OPTIONS) por 24 horas para acelerar la carga en Netlify
    'max_age' => 86400,

    // ⚠️ CRUCIAL: Debe estar en true para que el navegador permita enviar tokens de Sanctum
    'supports_credentials' => true,

];
