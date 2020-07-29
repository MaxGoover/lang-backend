<?php

namespace app\models\shop;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_goods".
 *
 * @property int $id                Id товара
 * @property int $group_id          Id группы товаров
 * @property string $title          Название товара
 * @property string $description    Описание товара
 * @property float $price           Цена товара
 * @property int $quantity          Цена товара
 */
class Goods extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%shop_goods}}';
    }

    public function getGroup(): ActiveQuery
    {
        return $this->hasOne(Group::class, ['group_id' => 'id']);
    }
}
