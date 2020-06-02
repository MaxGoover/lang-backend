<?php

$controllerMap = require __DIR__ . '/controllerMap.php';
$db = require __DIR__ . '/db.php';
$mongodb = require __DIR__ . '/mongodb.php';
$params = require __DIR__ . '/params.php';

$config = [
    'aliases'             => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'components'          => [
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],
        'cache'       => [
            'class' => yii\caching\FileCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'categories' => ['console_errors'],
                    'class'      => yii\log\FileTarget::class,
                    'logFile'    => '@runtime/logs/console_errors.log',
                ],
                [
                    'categories' => ['console_success'],
                    'class'      => yii\log\FileTarget::class,
                    'logFile'    => '@runtime/logs/console_success.log',
                ],
            ],
        ],
        'db'          => $db,
        'i18n'        => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                ],
            ],
        ],
        'mongodb'     => $mongodb,
    ],
    'controllerMap'       => $controllerMap,
    'controllerNamespace' => 'app\commands',
    'id'                  => env('APP_ID') . '-console',
    'params'              => $params,

];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'      => yii\gii\Module::class,
        'generators' => [
            'mongoDbModel' => [
                'class' => yii\mongodb\gii\model\Generator::class
            ]
        ],
        'allowedIPs' => ['*'],
    ];
}

return $config;
