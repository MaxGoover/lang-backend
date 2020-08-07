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
                ->decimal(5, 2)
                ->unsigned()
                ->notNull()
                ->comment('Цена товара'),
            'in_stock'    => $this
                ->integer()
                ->unsigned()
                ->comment('Количество товара на складе'),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица товаров"'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%shop_goods}}');
    }
}
