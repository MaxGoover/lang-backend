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
    'bootstrap'  => [
//        'bootstrap\SetUp',
        'log',
    ],
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
            'useFileTransport' => true,
        ],
        'mongodb'      => $mongodb,
        'request'      => [
            'baseUrl' => env('BASE_URL'),
            'cookieValidationKey' => env('COOKIE_VALIDATION_KEY'),
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ]
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
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        'generators' => [
            'mongoDbModel' => [
                'class' => yii\mongodb\gii\model\Generator::class
            ]
        ],
        'allowedIPs' => ['*'],
    ];
}

return $config;
