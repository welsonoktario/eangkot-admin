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

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'broadcasting/*'],

    'allowed_methods' => ['POST', 'GET', 'PATCH', 'PUT'],

    'allowed_origins' => [
        'http://localhost:8100/*',
        'http://localhost:8100',
        'http://localhost:8101/*',
        'http://localhost:8101',
        'http://localhost:5173/*',
        'http://localhost:5173',
        'http://localhost/*',
        'http://localhost'
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Accept', 'Content-Type', 'Referer', 'User-Agent', 'Authorization', 'x-xsrf-token'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
