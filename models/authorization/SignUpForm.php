<?php

namespace app\models\authorization;

use app\models\user\User;
use app\models\user\UserTokenDTO;
use Yii;
use yii\base\Model;

/**
 * Class SignUpForm
 * @package app\models\authorization
 */
class SignUpForm extends Model
{
    public $username;
    public $password;

    /**
     * User's token DTO.
     *
     * @var UserTokenDTO|null
     */
    private $_tokenDto;

    /**
     * Returns user's token DTO.
     *
     * @return UserTokenDTO|null
     */
    public function getTokenDto()
    {
        return $this->_tokenDto;
    }

    /**
     * Signs user up.
     *
     * @return User|null
     * @throws \yii\base\Exception
     */
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
