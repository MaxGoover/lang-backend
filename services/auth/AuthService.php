<?php

namespace app\services\auth;

use app\forms\auth\LoginForm;
use app\models\user\User;
use app\repositories\UserRepository;

class AuthService
{
    private UserRepository $_userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->_userRepository->getByUsername($form->username);
        if (!$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }
        return $user;
    }
}