<?php

namespace app\other\bootstrap;

use yii\base\BootstrapInterface;
use yii\rbac\ManagerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(
            ManagerInterface::class, fn() => $app->authManager
        );

        $container->setSingleton(Cart::class, function() use ($app) {
            return new Cart(
                new SimpleCost(),
                new HybridStorage(
                    'cart',
                    3600 * 24,
                    $app->db,
                    $app->get('user'))
            );
        });
    }
}
