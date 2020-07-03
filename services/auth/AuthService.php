<?php

namespace app\services\auth;

use app\forms\auth\LoginForm;
use app\identity\Identity;
use app\models\user\User;
use app\repositories\user\UserRepository;
use Yii;

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

    public function login (User $user, bool $rememberMe): void
    {
        $this->_userRepository->save($user);
        Yii::$app->user->login(new Identity($user), $rememberMe ? 2592000 : 0);
    }

    public function logout(): void
    {
        Yii::$app->user->logout();
    }
}