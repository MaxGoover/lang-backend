<?php

namespace app\other\cart;

//use shop\entities\Shop\Product\Modification;
use app\models\shop\Goods;

class CartItem
{
    private Goods $_goods;
//    private $_modificationId;
    private int $_quantity;

    public function __construct(Goods $goods, int $quantity)
    {
        if (!$goods->canBeCheckout($quantity)) {
            throw new \DomainException('Quantity is too big.');
        }
        $this->_goods = $goods;
        $this->_quantity = $quantity;
    }

    public function changeQuantity($quantity): self
    {
        return new static($this->_product, $this->_modificationId, $quantity);
    }

    public function getCost(): int
    {
        return $this->getPrice() * $this->_quantity;
    }

    public function getId(): string
    {
        return \md5(serialize([$this->_product->id, $this->_modificationId]));
    }

    public function getModification(): ?Modification
    {
        if ($this->_modificationId) {
            return $this->_product->getModification($this->_modificationId);
        }
        return null;
    }

    public function getModificationId(): ?int
    {
        return $this->_modificationId;
    }

    public function getPrice(): int
    {
        if ($this->_modificationId) {
            return $this->_product->getModificationPrice($this->_modificationId);
        }
        return $this->_product->price_new;
    }

    public function getProductId(): int
    {
        return $this->_product->id;
    }

    public function getProduct(): Product
    {
        return $this->_product;
    }

    public function getQuantity(): int
    {
        return $this->_quantity;
    }

    public function getWeight(): int
    {
        return $this->_product->weight * $this->_quantity;
    }

    public function plus($quantity): self
    {
        return new static($this->_product, $this->_modificationId, $this->_quantity + $quantity);
    }
}