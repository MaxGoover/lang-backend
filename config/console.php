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
        'log'         => [
            'targets' => [
                [
                    'class'  => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
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
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
    ];
}

return $config;
