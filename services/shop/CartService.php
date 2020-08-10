<?php

namespace app\services\shop;

use app\other\cart\Cart;
use app\other\cart\CartItem;
use app\repositories\shop\GoodsReadRepository;

class CartService
{
    private Cart $_cart;
    private GoodsReadRepository $_goodsReadRepository;

    public function __construct(Cart $cart, GoodsReadRepository $goodsReadRepository)
    {
        $this->_cart = $cart;
        $this->_goodsReadRepository = $goodsReadRepository;
    }

    public function add(int $goodsId): void
    {
        $goods = $this->_goodsReadRepository->getById($goodsId);
        $this->_cart->add(new CartItem($goods, 1));
    }

    public function clear(): void
    {
        $this->_cart->clear();
    }

    public function getCart(): Cart
    {
        return $this->_cart;
    }

    public function remove($id): void
    {
        $this->_cart->remove($id);
    }
}