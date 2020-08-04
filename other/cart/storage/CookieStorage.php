<?php

namespace app\other\cart\storage;

use app\models\shop\Goods;
use app\other\cart\CartItem;
use Yii;
use yii\helpers\Json;
use yii\web\Cookie;

class CookieStorage implements StorageInterface
{
    private string $_key;
    private int $_timeout;

    public function __construct(
        string $key,
        int $timeout
    )
    {
        $this->_key = $key;
        $this->_timeout = $timeout;

    }

    public function load(): array
    {
        if ($cookie = Yii::$app->request->cookies->get($this->_key)) {
            return array_filter(array_map(function (array $row) {
                if (isset($row['id'], $row['q']) && $goods = Goods::findOne($row['id'])) {
                    /** @var Goods $goods */
                    return new CartItem($goods, $row['q']);
                }
                return false;
            }, Json::decode($cookie->value)));
        }
        return [];
    }

    public function save(array $items): void
    {
        Yii::$app->response->cookies->add(new Cookie([
            'expire' => time() + $this->_timeout,
            'name' => $this->_key,
            'value' => Json::encode(array_map(function (CartItem $item) {
                return [
                    'id' => $item->getGoodsId(),
                    'q' => $item->getQuantity(),
                ];
            }, $items)),
        ]));
    }
} 