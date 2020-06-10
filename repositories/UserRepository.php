<?php

namespace app\repositories;

use app\models\user\User;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class UserRepository
{
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
