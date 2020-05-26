<?php

namespace app\models\authorization\login\loginForms;

use app\models\authorization\login\LoginFormInterface;
use app\models\user\User;
use app\models\user\UserTokenDTO;
use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only
 *
 */
class ScorecardLoginForm extends Model implements LoginFormInterface
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = null;

    /**
     * User's token DTO.
     *
     * @var UserTokenDTO|null
     */
    private $_tokenDto;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username'   => Yii::t('user', 'Username'),
            'password'   => Yii::t('user', 'Password'),
            'rememberMe' => Yii::t('user', 'Remember me'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('user','Incorrect username or password.'));
            }
        }
    }

    /**
     * {@inheritDoc}
     */
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

    /**
     * {@inheritDoc}
     */
    public function getUser(): ?User
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenDto(): ?UserTokenDTO
    {
        return $this->_tokenDto;
    }
}
