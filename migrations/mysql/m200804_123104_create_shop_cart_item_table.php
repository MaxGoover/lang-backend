<?php

use yii\db\Migration;

class m200804_123104_create_shop_cart_item_table extends Migration
{
    private string $_tableName = 'shop_cart_item';
    private string $_tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT="Таблица товаров корзины"';

    public function safeUp()
    {
        $this->createTable($this->_tableName, [
            'id'       => $this
                ->bigPrimaryKey(),
            'user_id'  => $this
                ->string(64)
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

        $this->createIndex('idx-' . $this->_tableName . '-goods_id', $this->_tableName, 'goods_id');

        $this->addForeignKey('fk-' . $this->_tableName . '-goods_id', $this->_tableName, 'goods_id', '{{%shop_goods}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable($this->_tableName);
    }
}
