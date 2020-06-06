<?php

namespace app\forms\user;

use app\models\user\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
    public string $password;
    public string $role;
    public string $username;

    public function rolesList(): array
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    ##################################################

    public function rules(): array
    {
        return [
            [['username', 'role'], 'required'],
            ['username', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
        ];
    }
}