<?php

return [
    'class' => yii\mongodb\Connection::class,
    'dsn' => 'mongodb://'
        . env('MONGO_DB_USERNAME') . ':'
        . env('MONGO_DB_PASSWORD') . '@'
        . env('MONGO_DB_HOST') . ':'
        . env('MONGO_DB_PORT') . '/'
        . env('MONGO_DB_DATABASE'),
];