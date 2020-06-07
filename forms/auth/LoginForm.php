<?php

namespace app\forms\auth;

use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public string $password;
    public bool $rememberMe = false;
    public string $username;

    public function rules(): array
    {
        return [
            [['rememberMe', 'password', 'username'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
}
