<?php

namespace app\services\auth;

use app\access\Rbac;
use app\forms\auth\SignupForm;
use app\managers\user\RoleManager;
use app\models\user\User;
use app\repositories\UserRepository;
use yii\web\Request;


class SignUpService
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

    public function signUp(SignupForm $form, Request $request)
    {
        $user = User::create(
            $form->username,
            $form->password,
            $request
        );
        $this->_userRepository->save($user);
        $this->_roleManager->assign($user->_id, Rbac::ROLE_USER);
        return $user;
    }
}