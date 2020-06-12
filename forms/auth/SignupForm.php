<?php

namespace app\forms\auth;

use app\models\user\User;
use yii\base\Model;

class SignupForm extends Model
{
    public string $username = '';
    public string $password = '';
    public bool $rememberMe = false;

    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'string', 'length' => [3, 48]],
            ['password', 'string', 'length' => [6, 24]],
            ['rememberMe', 'boolean'],
        ];
    }
}
