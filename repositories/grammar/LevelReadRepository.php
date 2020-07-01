<?php

namespace app\repositories\grammar;

use app\models\level\Level;
use app\models\training\Training;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\Query as MysqlQuery;

class LevelReadRepository
{
    public function getAll()
    {
        $query = new MysqlQuery();



//        Product::find()->andWhere(['brand_id' => $id])->exists();
//
//        $query = Training::find()->alias('t')->active('p');
//        $query->joinWith(['level ta'], false);
//        $query->andWhere(['ta.tag_id' => $tag->id]);
//        $query->groupBy('p.id');
//        return $this->_getProvider($query);
//
//        SELECT * FROM Products
//        WHERE EXISTS
//        (SELECT * FROM Orders WHERE Orders.ProductId = Products.Id)

//        'select * from training where level_id in (select id from level)'

        return \Yii::$app->db->createCommand(
            'SELECT * 
                FROM level 
                WHERE EXISTS (
                    SELECT * 
                    FROM training 
                    WHERE training.level_id = level.id
                )'
        )->queryAll();
    }

    private function _getProvider($query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }
}