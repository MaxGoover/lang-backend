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
    public function active()
    {
        return $this->andWhere(['status' => User::STATUS_ACTIVE]);
    }

    public function byId($_id)
    {
        return $this->andWhere(['_id' => $_id]);
    }

    public function byPasswordResetToken(string $passwordResetToken)
    {
        return $this->andWhere(['passwordResetToken' => $passwordResetToken]);
    }

    public function byRefreshToken(string $refreshToken)
    {
        return $this->andWhere(['tokens.refreshToken' => $refreshToken]);
    }

    public function byToken(string $token)
    {
        return $this->andWhere(['tokens.token' => $token]);
    }

    public function byUsername(string $username)
    {
        return $this->andWhere(['username' => $username]);
    }

    public function public()
    {
        return $this->select([
            '_id',
            'username',
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
