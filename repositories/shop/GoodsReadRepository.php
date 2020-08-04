<?php

namespace app\repositories\shop;

use app\models\shop\Goods;

class GoodsReadRepository
{
    public function find($id): ?Goods
    {
        return Goods::findOne($id);
    }
}