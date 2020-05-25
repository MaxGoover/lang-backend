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

    // RBAC migrations
    'migrate-rbac'    => [
        'class'          => MysqlController::class,
        'migrationPath'  => [
            '@app/migrations/rbac',
        ],
        'migrationTable' => 'migration_rbac',
    ],
];