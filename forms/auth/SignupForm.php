<?php

namespace app\forms\auth;

use app\models\user\User;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public string $password;
    public bool $rememberMe = false;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
}
