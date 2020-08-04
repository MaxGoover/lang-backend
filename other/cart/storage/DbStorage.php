<?php

namespace app\other\cart\storage;

use app\models\shop\Goods;
use app\other\cart\CartItem;
use yii\db\Connection;
use yii\db\Query;

class DbStorage implements StorageInterface
{
    private Connection $_db;
    private string $_tableName = 'shop_art_item';
    private string $_userId;

    public function __construct(
        Connection $db,
        string $userId
    )
    {
        $this->_db = $db;
        $this->_userId = $userId;
    }

    public function load(): array
    {
        $rows = (new Query())
            ->select('*')
            ->from($this->_tableName)
            ->where(['user_id' => $this->_userId])
            ->orderBy(['goods_id' => SORT_ASC])
            ->all($this->_db);

        return array_map(function(array $row) {
            /** @var Goods $goods */
            if($product = Goods::findOne($row['goods_id'])) {
                return new CartItem($goods, $row['quantity']);
            }

            return false;
        }, $rows);
    }

    public function save(array $items): void
    {
        $this->_db->createCommand()->delete($this->_tableName, [
            'user_id' => $this->_userId,
        ])->execute();

        $this->_db->createCommand()->batchInsert(
            $this->_tableName,
            [
                'user_id',
                'goods_id',
                'quantity'
            ],
            array_map(function(CartItem $item) {
                return [
                    'user_id'  => $this->_userId,
                    'goods_id' => $item->getGoodsId(),
                    'quantity' => $item->getQuantity(),
                ];
            }, $items)
        )->execute();
    }
} 