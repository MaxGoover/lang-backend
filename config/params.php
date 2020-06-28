<?php

return [
    'adminEmail' => 'admin@example.com',
    'secondsToAccessTokenExpires'=> 900,
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'tableTextMaxLength' => 1000,

    // MongoDB DB name
    'mongoDBName' => env('MONGO_DB_DATABASE'),

    // Path to uploaded video files
    'videoFilesPath'     => 'videos/',

    // Настройки Cors для пользования API
    'apiCorsOptions' => [
        'Origin'                           => [env('CORS_ORIGIN')],
        'Access-Control-Request-Method'    => ['POST', 'OPTIONS'], // методы, которые мы разрешаем
        'Access-Control-Request-Headers'   => ['*'], // разрешаем пока что все заголовки
        'Access-Control-Allow-Credentials' => null,
        'Access-Control-Max-Age'           => 86400,
    ],
];
