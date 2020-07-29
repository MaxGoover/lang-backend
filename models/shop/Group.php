<?php

namespace app\models\shop;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_group".
 *
 * @property int $id            Id группы товаров
 * @property string $title      Название группы товаров
 * @property int $sort          Сортировка
 */
class Group extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%shop_group}}';
    }

    public function getGoods(): ActiveQuery
    {
        return $this->hasMany(Goods::class, ['id' => 'group_id']);
    }
}
