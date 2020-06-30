<?php

use yii\console\controllers\MigrateController as MysqlController;
use yii\mongodb\console\controllers\MigrateController as MongodbController;

return [
    'fixture' => [ // Fixture generation command line.
        'class' => yii\faker\FixtureController::class,
    ],

    // Menu migrations
    'migrate-menu'    => [
        'class'          => MysqlController::class,
        'migrationPath'  => [
            '@app/migrations/menu',
        ],
        'migrationTable' => 'migration_menu',
    ],

    // MongoDB migrations
    'migrate-mongodb' => [
        'class'         => MongodbController::class,
        'migrationPath' => [
            '@app/migrations/mongodb',
        ],
    ],

    // MongoDB fill migrations
    'migrate-mongodb-fill' => [
        'class'         => MongodbController::class,
        'migrationPath' => [
            '@app/migrations/mongodb-fill',
        ],
    ],

    // MySQL migrations
    'migrate-mysql'   => [
        'class'          => MysqlController::class,
        'migrationPath'  => [
            '@app/migrations/mysql',
            '@yii/rbac/migrations',
            '@mdm/admin/migrations',
        ],
        'migrationTable' => 'migration',
    ],

    // MySQL fill migrations
    'migrate-mysql-fill'   => [
        'class'          => MysqlController::class,
        'migrationPath'  => [
            '@app/migrations/mysql-fill',
        ],
        'migrationTable' => 'migration_fill',
    ],

    // RBAC migrations
    'migrate-rbac'    => [
        'class'          => MysqlController::class,
        'migrationPath'  => [
            '@app/migrations/rbac',
        ],
        'migrationTable' => 'migration_rbac',
    ],
];