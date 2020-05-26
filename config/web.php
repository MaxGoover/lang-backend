<?php

use app\models\user\User;

$db = require __DIR__ . '/db.php';
$mongodb = require __DIR__ . '/mongodb.php';
$params = require __DIR__ . '/params.php';

$config = [
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'as access'  => [
        'class'        => mdm\admin\components\AccessControl::class,
        'allowActions' => [
            '*' // пока что доступ ко всему '*', потом уберем
        ]
    ],
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'components' => [
        'authManager'  => [
            'class'        => yii\rbac\DbManager::class,
            'defaultRoles' => ['guest'],
        ],
        'cache'        => [
            'class' => yii\caching\FileCache::class,
        ],
        'db'           => $db,
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n'         => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                ],
            ],
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer'       => [
            'class'            => yii\swiftmailer\Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'mongodb'      => $mongodb,
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('COOKIE_VALIDATION_KEY'),
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'rules'           => [],
            'showScriptName'  => false,
        ],
        'user'         => [
            'identityClass' => User::class,
//            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl'      => ['site/login'],
        ],
    ],
    'id'         => env('APP_ID'),
    'language'   => env('APP_LANGUAGE'),
    'modules'    => [
        'rbac' => [
            'class'         => mdm\admin\Module::class,
            'controllerMap' => [
                'assignment' => [
                    'class'         => mdm\admin\controllers\AssignmentController::class,
                    'userClassName' => User::class,
                    'idField'       => '_id',
                    'usernameField' => 'username',
                ],
            ],
            'layout'        => 'left-menu',
            'mainLayout'    => '@app/views/layouts/main.php',
        ]
    ],
    'name'       => env('APP_NAME'),
    'params'     => $params,
    'timeZone'   => env('APP_TIME_ZONE'),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
