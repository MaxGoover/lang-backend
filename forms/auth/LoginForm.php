<?php

namespace app\forms\auth;

use app\models\user\User;
use app\models\user\UserTokenDTO;
use Yii;
use yii\base\Exception;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public string $password;
    public bool $rememberMe = false;

    private $_tokenDto;
    private $_user;

    public function login(): bool
    {
        if ($this->validate()) {
            if ($user = $this->getUser()) {
                try {
                    $this->_tokenDto = $user->refreshToken();

                    if ($user->save()) {
                        return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                    }
                } catch (Exception $e) {
                }
            }
        }

        return false;
    }

    public function getTokenDto(): ?UserTokenDTO
    {
        return $this->_tokenDto;
    }

    public function getUser(): ?User
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    ##################################################

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
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
}
