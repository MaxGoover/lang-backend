<?php

use yii\db\Migration;

class m200729_141911_create_shop_goods_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%shop_goods}}', [
            'id'          => $this
                ->primaryKey(),
            'group_id'    => $this
                ->integer()
                ->notNull()
                ->comment('Id группы товаров'),
            'title'       => $this
                ->string()
                ->unique()
                ->notNull()
                ->comment('Название товара'),
            'description' => $this
                ->text()
                ->comment('Описание товара'),
            'price'       => $this
                ->float(2)
                ->unsigned()
                ->notNull()
                ->comment('Цена товара'),
            'quantity'    => $this
                ->integer()
                ->unsigned()
                ->comment('Количество товара'),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица товаров"'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%shop_goods}}');
    }
}