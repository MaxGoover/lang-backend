<?php

namespace app\forms\shop;

use app\models\shop\Goods;
use yii\base\Model;

class AddToCartForm extends Model
{
    public int $quantity;
    private Goods $_goods;

    public function __construct(Goods $goods, $config = [])
    {
        $this->_goods = $goods;
        $this->quantity = 1;
        parent::__construct($config);
    }

    ##################################################

    public function rules(): array
    {
        return [
            [['goodsId', 'quantity'], 'required'],
            ['quantity', 'integer', 'max' => $this->_goods->quantity],
        ];
    }
}