<?php

use yii\db\Migration;

class m200804_123104_create_shop_cart_item_table extends Migration
{
    private string $_tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица товаров корзины"';

    public function safeUp()
    {
        $this->createTable('{{%shop_cart_item}}', [
            'id'       => $this
                ->bigPrimaryKey(),
            'user_id'  => $this
                ->integer()
                ->notNull()
                ->comment('Id пользователя'),
            'goods_id' => $this
                ->integer()
                ->notNull()
                ->comment('Id товара'),
            'quantity' => $this
                ->integer()
                ->unsigned()
                ->notNull()
                ->comment('Количество товаров'),
        ],
            $this->_tableOptions
        );

        $this->createIndex('{{%idx-shop_cart_item-user_id}}', '{{%shop_cart_item}}', 'user_id');
        $this->createIndex('{{%idx-shop_cart_item-goods_id}}', '{{%shop_cart_item}}', 'goods_id');

        $this->addForeignKey('{{%fk-shop_cart_item-user_id}}', '{{%shop_cart_item}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-shop_cart_item-goods_id}}', '{{%shop_cart_item}}', 'goods_id', '{{%shop_products}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%shop_cart_item}}');
    }
}
