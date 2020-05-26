<?php

namespace app\models\authorization;

use app\models\user\User;
use app\models\user\UserTokenDTO;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public string $password;
    public bool $rememberMe = false;

    private UserTokenDTO $_tokenDto;
    private $_user = false;

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if ($user = $this->getUser()) {
                try {
                    $this->_tokenDto = $user->refreshToken();

                    if ($user->save()) {
                        return Yii::$app->user->login($user, $this->rememberMe ? 2592000 : 0);

                    }
                } catch (\Exception $e) {
                }
            }
        }

        return false;
    }

    public function getTokenDto(): UserTokenDTO {
        return $this->_tokenDto;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    ##################################################

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }
}
