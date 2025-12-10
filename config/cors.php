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
    // http://localhost:5173

    'paths' => ['*'],

    'allowed_methods' => [
       '*'
    ],

    'allowed_origins' => [
        'https://storeapi.fhmcoding.com',
        'http://storeapi.fhmcoding.com',
        'storeapi.fhmcoding.com',
        'store.fhmcoding.com',
        'https://store.fhmcoding.com',
        'http://store.fhmcoding.com'

    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
