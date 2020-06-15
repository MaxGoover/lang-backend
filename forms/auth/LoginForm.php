<?php

namespace app\forms\auth;

use app\models\user\User;
use app\models\user\UserTokenDTO;
use Yii;
use yii\base\Exception;
use yii\base\Model;

class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';
    public bool $rememberMe = false;

    public function attributeLabels(): array
    {
        return [
            'username'   => Yii::t('user', 'Username'),
            'password'   => Yii::t('user', 'Password'),
            'rememberMe' => Yii::t('user', 'Remember me'),
        ];
    }

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
