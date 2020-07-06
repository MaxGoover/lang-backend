<?php

use yii\db\Migration;

class m200630_124134_create_level_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%level}}',
            [
                'id'          => $this
                    ->primaryKey(),
                'title'       => $this
                    ->string()
                    ->unique()
                    ->notNull()
                    ->comment('Название уровня'),
                'description' => $this
                    ->text()
                    ->comment('Описание уровня'),
                'code'        => $this
                    ->string(2)
                    ->notNull()
                    ->unique()
                    ->comment('Код уровня'),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица уровней знания английского языка"'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%level}}');
    }
}
