<?php

namespace app\other\cart;

//use shop\entities\Shop\Product\Modification;
use app\models\shop\Goods;

class CartItem
{
    private Goods $_goods;
    private int $_quantity;

    public function __construct(Goods $goods, int $quantity)
    {
        if (!$goods->canBeCheckout($quantity)) {
            throw new \DomainException('Quantity is too big.');
        }
        $this->_goods = $goods;
        $this->_quantity = $quantity;
    }

    public function getGoodsId(): string
    {
        return $this->_goods->id;
    }

    public function getQuantity(): int
    {
        return $this->_quantity;
    }
}