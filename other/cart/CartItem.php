<?php

namespace app\other\cart;

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

    public function getCost(): int
    {
        return $this->getPrice() * $this->_quantity;
    }

    public function getGoodsId(): string
    {
        return $this->_goods->id;
    }

    public function getPrice(): float
    {
        return $this->_goods->price;
    }

    public function getQuantity(): int
    {
        return $this->_quantity;
    }
}