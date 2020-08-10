<?php

namespace app\other\identity;

use app\models\user\User;
use yii\web\IdentityInterface;

class Identity implements IdentityInterface
{
    private User $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public static function findIdentity($_id): ?User
    {
        return User::find()->byId($_id)->active()->one();
    }

    public static function findIdentityByAccessToken($token, $type = null): ?User
    {
        return User::find()->byToken($token)->one();
    }

    public function getAuthKey(): string
    {
        return $this->_user->authKey;
    }

    public function getId(): string
    {
        return $this->_user->_id;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }
}
