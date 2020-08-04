<?php

use yii\db\Migration;

class m200804_123005_create_user_table extends Migration
{
    private string $_tableName = 'user';
    private string $_tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица пользователей"';

    public function safeUp()
    {
        $this->createTable($this->_tableName, [
            'id' => $this
                ->primaryKey(),
            'username' => $this
                ->string(32)
                ->unique()
                ->notNull(),
        ],
            $this->_tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->_tableName);
    }
}
