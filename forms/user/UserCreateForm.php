<?php

namespace app\forms\user;

use app\models\user\User;
use yii\base\Model;

class UserCreateForm extends Model
{
    public string $password;
    public string $username;

    ##################################################

    public function rules(): array
    {
        return [
            [['password', 'username'], 'required'],
            ['username', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
        ];
    }
}