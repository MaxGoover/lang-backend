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
    public $email;
    public $password;
    public $retypePassword;

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

            $user->username = $this->email;
            $user->email = $this->email;
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $this->_tokenDto = $user->refreshToken();

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    ##################################################

    /**
     * @return array
     */
    public function rules()
    {
        $class = Yii::$app->getUser()->identityClass ?: 'app\models\user\User';

        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => $class,
                'message'     => Yii::t('rbac-admin', 'This email address has already been taken.')
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 255],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }
}
