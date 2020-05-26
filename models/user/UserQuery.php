<?php

namespace app\models\user;

use yii\mongodb\ActiveQuery;

/**
 * This is the ActiveQuery class for [[user]].
 *
 * @see User
 */
class UserQuery extends ActiveQuery
{
    /**
     * Returns only active items.
     *
     * @return UserQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => User::STATUS_ACTIVE]);
    }

    /**
     * Finds user model by id.
     *
     * @param $id
     * @return UserQuery
     */
    public function byId($id)
    {
        return $this->andWhere(['_id' => $id]);
    }

    /**
     * Finds user by password reset token.
     *
     * @param $passwordResetToken
     * @return UserQuery
     */
    public function byPasswordResetToken($passwordResetToken)
    {
        return $this->andWhere(['passwordResetToken' => $passwordResetToken]);
    }

    /**
     * Finds model by refresh token.
     *
     * @param $refreshToken
     * @return UserQuery
     */
    public function byRefreshToken($refreshToken)
    {
        return $this->andWhere(['tokens.refreshToken' => $refreshToken]);
    }

    /**
     * Finds model by token.
     *
     * @param $token
     * @return UserQuery
     */
    public function byToken($token)
    {
        return $this->andWhere(['tokens.token' => $token]);
    }

    /**
     * Finds user model by username.
     *
     * @param $username
     * @return UserQuery
     */
    public function byUsername($username)
    {
        return $this->andWhere(['username' => $username]);
    }

    /**
     * Selects public fields only.
     *
     * @return UserQuery
     */
    public function public()
    {
        return $this->select([
            '_id',
            'username',
            'email',
            'created_at',
            'updated_at',
        ]);
    }

    ##################################################

    /**
     * {@inheritdoc}
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
