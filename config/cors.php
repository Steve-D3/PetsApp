<?php

return [
    'paths' => [
        'api/*',
        'login',
        'logout',
        'sanctum/csrf-cookie',
        'docs/*',
        'docs.json',
        'docs/*/*',
    ],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 60 * 60 * 24, // 24 hours
    'supports_credentials' => true,
];
