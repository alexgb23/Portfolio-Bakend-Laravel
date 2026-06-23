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
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://portfolioalexsys.netlify.app',
        'http://localhost:5173', // Para que puedas seguir programando y probando en tu casa/colegio
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];




    /*

    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    // 'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // // 1. Restringe los métodos HTTP a los que realmente usa tu frontend
    // 'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],

    // 'allowed_origins' => [
    //     'https://portfolioalexsys.netlify.app',
    //     'http://localhost:5173', 
    // ],

    // 'allowed_origins_patterns' => [],

    // // 2. Especifica solo las cabeceras necesarias en lugar de usar '*'
    // 'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept'],

    // 'exposed_headers' => [],

    // // 3. Activa la caché de CORS (en segundos) para evitar peticiones "preflight" repetidas
    // 'max_age' => 86400,

    // // 4. Cámbialo a true si tu frontend va a usar Cookies, Sesiones o Laravel Sanctum
    // 'supports_credentials' => true,
