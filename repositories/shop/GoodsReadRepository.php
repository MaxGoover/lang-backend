<?php

namespace app\repositories\shop;

use app\models\shop\Goods;
use app\repositories\NotFoundException;

class GoodsReadRepository
{
    public function getById($id): ?Goods
    {
        if (!$goods = Goods::findOne($id)) {
            throw new NotFoundException('Goods is not found.');
        }
        return $goods;
    }
}