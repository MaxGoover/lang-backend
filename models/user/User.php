<?php

namespace app\models\user;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\mongodb\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord implements IdentityInterface
{
    use UserTokenTrait;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @param int|string $id
     * @return IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return self::find()->byId($id)->active()->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->byToken($token)->one();
    }

    /**
     * Finds user by its refresh token.
     *
     * @param $refreshToken
     * @return User|null|ActiveRecord
     */
    public static function findIdentityByRefreshToken($refreshToken)
    {
        return static::find()->byRefreshToken($refreshToken)->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
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

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    ##################################################

    /**
     * @return array
     */
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

    /**
     * @return string[]
     */
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

    /**
     * @return array|array[]
     */
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

    /**
     * @return array
     */
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
//            ['email', 'unique', 'message' => Yii::t('rbac-admin', 'This email address has already been taken.')],
            ['email', 'unique', 'message' => Yii::t('rbac-admin', 'This email address has already been taken.')],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
//            [['logins', 'projectsIds'], 'each', 'rule' => ['string']],
//            [['_id','username','passwordHash','passwordResetToken','email','wfmNumber','authKey','tokens','logins',
//                'name','surname','middleName','webSettings','projectsIds','status','createdAt','updatedAt',], 'safe']
        ];
    }
}
