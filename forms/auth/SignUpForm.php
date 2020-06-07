<?php

namespace app\forms\auth;

use app\models\user\User;
use yii\base\Model;

class SignUpForm extends Model
{
    public string $password;
    public bool $rememberMe = false;
    public string $username;

    public function rules(): array
    {
        return [
            ['username', 'trim'],
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['rememberMe', 'boolean'],
        ];
    }
}
