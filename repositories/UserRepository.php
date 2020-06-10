<?php

namespace app\repositories;

use app\models\user\User;
use app\services\user\UserService;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class UserRepository
{
    private UserService $_userService;

    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }

    public static function save (User $user) {
        if (!$user->save(false)) {
            throw new ServerErrorHttpException('Model save error');
        }
    }

    public function getByUsername(string $username): User
    {
        return $this->_getBy(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    private static function _getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('User not found');
        }
        return $user;
    }
}
