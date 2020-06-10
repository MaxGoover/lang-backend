<?php

namespace app\services\auth;

use app\forms\auth\SignupForm;
use app\models\user\User;
use app\repositories\UserRepository;
Use RoleMa

class SignupService
{
    private UserRepository $_userRepository;
    private $_roleManager;
    private $_transaction;

    public function __construct(
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->_users = $users;
        $this->_roles = $roles;
        $this->_transaction = $transaction;
    }

    public function signup(SignupForm $form)
    {
        $user = User::create(
            $form->username,
            $form->password
        );

    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->_users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->_users->save($user);
    }

//    public function signup(SignupForm $form): void
//    {
//        $user = User::requestSignup(
//            $form->username,
//            $form->email,
//            $form->phone,
//            $form->password
//        );
//        $this->_transaction->wrap(function () use ($user) {
//            $this->_users->save($user);
//            $this->_roles->assign($user->id, Rbac::ROLE_USER);
//        });
//    }
}