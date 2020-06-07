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
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public static function create(
        string $username,
        string $password): self
    {
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->status = self::STATUS_ACTIVE;
        $user->authKey = Yii::$app->security->generateRandomString();
        return $user;
    }

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
    public static function findIdentityByAccessToken($token, $type = null): self
    {
        return static::find()->byToken($token)->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): ?self
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
     * Returns only public data.
     *
     * @return array
     */
    public function getPublicData()
    {
        return [
            'id'       => $this->_id,
            'username' => $this->username,
            'email'    => $this->email,
            'roles'    => Yii::$app->authManager->getRolesByUser($this->_id),
        ];
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
//            ['email', 'unique', 'message' => Yii::t('admin', 'This email address has already been taken.')],
            ['email', 'unique', 'message' => Yii::t('admin', 'This email address has already been taken.')],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
//            [['logins', 'projectsIds'], 'each', 'rule' => ['string']],
//            [['_id','username','passwordHash','passwordResetToken','email','wfmNumber','authKey','tokens','logins',
//                'name','surname','middleName','webSettings','projectsIds','status','createdAt','updatedAt',], 'safe']
        ];
    }








    public static function requestSignup(
        string $username,
        string $email,
        string $phone,
        string $password): self
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->phone = $phone;
        $user->setPassword($password);
        $user->created_at = \time();
        $user->status = self::STATUS_WAIT;
        $user->email_confirm_token = Yii::$app->security->generateRandomString();
        $user->_generateAuthKey();
        $user->recordEvent(new UserSignUpRequested($user));
        return $user;
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
            'password_reset_token' => $token,
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
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) \substr($token, \strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= \time();
    }

    public static function signupByNetwork($network, $identity): self
    {
        $user = new User();
        $user->created_at = \time();
        $user->status = self::STATUS_ACTIVE;
        $user->_generateAuthKey();
        $user->networks = [Network::create($network, $identity)];
        return $user;
    }

    public function addToWishList($productId): void
    {
        $items = $this->wishlistItems;
        foreach ($items as $item) {
            if ($item->isForProduct($productId)) {
                throw new \DomainException('Item is already added.');
            }
        }
        $items[] = WishlistItem::create($productId);
        $this->wishlistItems = $items;
    }

    public function attachNetwork($network, $identity): void
    {
        $networks = $this->networks;
        foreach ($networks as $current) {
            if ($current->isFor($network, $identity)) {
                throw new \DomainException('Network is already attached.');
            }
        }
        $networks[] = Network::create($network, $identity);
        $this->networks = $networks;
    }

    public function confirmSignup(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm_token = null;
        $this->recordEvent(new UserSignUpConfirmed($this));
    }

    public function edit(string $username, string $email, string $phone): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = \time();
    }

    public function editProfile(string $email, string $phone): void
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = \time();
    }

    public function getNetworks(): ActiveQuery
    {
        return $this->hasMany(Network::class, ['user_id' => 'id']);
    }

    public function getWishlistItems(): ActiveQuery
    {
        return $this->hasMany(WishlistItem::class, ['user_id' => 'id']);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function removeFromWishList($productId): void
    {
        $items = $this->wishlistItems;
        foreach ($items as $i => $item) {
            if ($item->isForProduct($productId)) {
                unset($items[$i]);
                $this->wishlistItems = $items;
                return;
            }
        }
        throw new \DomainException('Item is not found.');
    }

    public function requestPasswordReset(): void
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new \DomainException('Password resetting is already requested.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . \time();
    }

    public function resetPassword($password): void
    {
        if (empty($this->password_reset_token)) {
            throw new \DomainException('Password resetting is not requested.');
        }
        $this->setPassword($password);
        $this->password_reset_token = null;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    private function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    private function _generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    ##################################################

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['networks', 'wishlistItems'],
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }




}
