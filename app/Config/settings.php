<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Facebook settings
        'facebook' => [
            'app_id' => '{app-id}',
            'app_secret' => '{app-secret}',
            'app_token' => '{app-token}'
        ],
    ]
];
