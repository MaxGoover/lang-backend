<?php

namespace app\repositories;

use app\models\user\User;

class UserRepository
{
    public function findByUsername(string $username): ?User
    {
        return User::find()->andWhere(['username' => $username])->one();
    }

    public function getById($_id): User
    {
        return $this->_getBy(['_id' => $_id]);
    }

    public function getByUsername(string $username): User
    {
        return $this->_getBy(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function delete(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    private function _getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
//            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}