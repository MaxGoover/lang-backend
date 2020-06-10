<?php

return [
    'adminEmail' => 'admin@example.com',
    'secondsToAccessTokenExpires'=> 900,
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    // Настройки Cors для пользования API
    'apiCorsOptions'              => [
        'Origin'                           => [env('CORS_ORIGIN')],
        'Access-Control-Request-Method'    => ['POST'], // методы, которые мы разрешаем
        'Access-Control-Request-Headers'   => ['*'], // разрешаем пока что все заголовки
        'Access-Control-Allow-Credentials' => null,
        'Access-Control-Max-Age'           => 86400,
    ],
];
