<?php

namespace app\services\user;

use app\forms\user\UserCreateForm;
use app\forms\user\UserEditForm;
use app\managers\user\RoleManager;
use app\models\user\User;
use app\repositories\UserRepository;

class UserService
{
    private $_repository;
    private $_roles;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles
    )
    {
        $this->_repository = $repository;
        $this->_roles = $roles;
    }

    /**
     * Привязываем роль к пользователю.
     * @param $_id
     * @param $role
     */
    public function assignRole($_id, $role): void
    {
        $user = $this->_repository->getById($_id);
        $this->_roles->assign($user->_id, $role);
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->password,
            $form->username
        );
        $this->_repository->save($user);
        $this->_roles->assign($user->_id, 'user');
        return $user;
    }

    public function edit($_id, UserEditForm $form): void
    {
        $user = $this->_repository->getById($_id);
        $user->edit($form->username);
        $this->_repository->save($user);
        $this->_roles->assign($user->_id, 'user');
    }

    public function remove($_id): void
    {
        $user = $this->_repository->getById($_id);
        $this->_repository->delete($user);
    }
}