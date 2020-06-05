<?php

namespace app\forms\user;

use app\models\user\User;
use yii\base\Model;

class UserEditForm extends Model
{
    public string $password;
    public string $username;

    private User $_user;

    public function __construct(User $user, $config = [])
    {
        $this->password = $user->password;
        $this->username = $user->username;
        $this->_user = $user;
        parent::__construct($config);
    }

    ##################################################

    public function rules(): array
    {
        return [
            ['username', 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->_id]],
        ];
    }
}