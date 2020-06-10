<?php

namespace app\services\user;

use app\models\user\User;

class UserService
{
    public function refreshToken(User $user) {
        return $user->refreshToken();
    }
}