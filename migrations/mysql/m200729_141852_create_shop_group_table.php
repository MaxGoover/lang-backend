<?php

use yii\db\Migration;

class m200729_141852_create_shop_group_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%shop_group}}',
            [
                'id'          => $this
                    ->primaryKey(),
                'title'       => $this
                    ->string()
                    ->unique()
                    ->notNull()
                    ->comment('Название группы товаров'),
                'sort'        => $this
                    ->integer()
                    ->unsigned()
                    ->comment('Сортировка группы товаров')
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица групп товаров"'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%shop_group}}');
    }
}
