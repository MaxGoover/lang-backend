<?php


namespace app\models\authorization\login;


use app\models\user\User;
use app\models\user\UserTokenDTO;

/**
 * Interface LoginFormInterface
 * @package app\models\authorization
 */
interface LoginFormInterface
{
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool; // возвращает - авторизовался ли пользователь или нет

    /**
     * Finds user by username.
     *
     * @return User|null
     */
    public function getUser(): ?User;

    /**
     * Returns user's token DTO.
     *
     * @return UserTokenDTO|null
     */
    public function getTokenDto(): ?UserTokenDTO;
}