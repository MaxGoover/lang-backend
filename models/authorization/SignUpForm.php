<?php

namespace app\models\authorization;

use app\models\user\User;
use app\models\user\UserTokenDTO;
use yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $password;

    public function signUp()
    {
        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->refreshToken();

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    ##################################################

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
}
