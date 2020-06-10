<?php

namespace app\services\auth;

use app\forms\auth\SignupForm;
use app\identity\Identity;
use app\models\user\User;
use app\repositories\UserRepository;
use app\managers\RoleManager;
use app\access\Rbac;
use Yii;

class SignupService
{
    private RoleManager $_roleManager;
    private UserRepository $_userRepository;

    public function __construct(
        RoleManager $roleManager,
        UserRepository $userRepository
    )
    {
        $this->_roleManager = $roleManager;
        $this->_userRepository = $userRepository;
    }

    public function signup(SignupForm $form)
    {
        $user = User::create(
            $form->username,
            $form->password
        );
        $this->_userRepository->save($user);
        $this->_roleManager->assign($user->_id, Rbac::ROLE_USER);
        Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
        return $user;
    }
}