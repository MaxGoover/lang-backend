<?php

namespace app\models\user;

use app\forms\token\TokensForm;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\mongodb\ActiveRecord;
use yii\web\Request;

/**
 * Class user.
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 *
 * @property string $username
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property string $email
 * @property string $authKey
 * @property string $password write-only password
 *
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property array $tokens
 * @property array $logins
 * @property array $publicData Returns only user's public data
 */
class User extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public static function create(
        string $username,
        string $password,
        Request $request
    ): self
    {
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->status = self::STATUS_ACTIVE;
        $user->authKey = Yii::$app->security->generateRandomString();
        $user->tokens = new TokensForm($request);
        return $user;
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getPublicData()
    {
        return [
            'id'       => $this->_id,
            'username' => $this->username,
            'email'    => $this->email,
            'roles'    => Yii::$app->authManager->getRolesByUser($this->_id),
        ];
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    ##################################################

    public static function collectionName(): array
    {
        return [env('MONGO_DB_DATABASE'), 'user'];
    }

    public function attributeLabels()
    {
        return [
            '_id'                => Yii::t('user', 'ID'),
            'username'           => Yii::t('user', 'Username'),
            'passwordHash'       => Yii::t('user', 'Password Hash'),
            'passwordResetToken' => Yii::t('user', 'Password Reset Token'),
            'email'              => Yii::t('user', 'Email'),
            'authKey'            => Yii::t('user', 'Auth Key'),
            'tokens'             => Yii::t('user', 'Tokens'),
            'logins'             => Yii::t('user', 'Logins'),
            'status'             => Yii::t('user', 'Status'),
            'createdAt'          => Yii::t('user', 'Created At'),
            'updatedAt'          => Yii::t('user', 'Updated At'),
        ];
    }

    public function attributes(): array
    {
        return [
            '_id',
            'username',
            'passwordHash',
            'passwordResetToken',
            'email',
//            'wfmNumber',
            'authKey',
            'tokens',
//            'logins',
//            'name',
//            'surname',
//            'middleName',
//            'webSettings',
//            'projectsIds',
            'status',
            'createdAt',
            'updatedAt',
        ];
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ]
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['username', 'passwordHash', 'status'], 'required'],
            ['username', 'unique'],
            [['username', 'passwordHash', 'passwordResetToken', 'authKey'], 'string'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            ['tokens', 'checkTokens'],
//            ['webSettings', 'checkWebSettings'],
            [['username', 'email'], 'filter', 'filter' => 'trim'],
            ['email', 'email'],
//            ['email', 'unique', 'message' => Yii::t('admin', 'This email address has already been taken.')],
            ['email', 'unique', 'message' => Yii::t('admin', 'This email address has already been taken.')],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
//            [['logins', 'projectsIds'], 'each', 'rule' => ['string']],
//            [['_id','username','passwordHash','passwordResetToken','email','wfmNumber','authKey','tokens','logins',
//                'name','surname','middleName','webSettings','projectsIds','status','createdAt','updatedAt',], 'safe']
        ];
    }
}
