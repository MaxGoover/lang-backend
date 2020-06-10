<?php

namespace app\repositories;

use app\models\user\User;
use yii\mongodb\ActiveRecord;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function getByUsername(string $username): User
    {
        return $this->_getBy(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    private function _getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new \RuntimeException('User not found');
        }
        return $user;
    }
}
