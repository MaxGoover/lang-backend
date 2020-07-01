<?php

namespace app\repositories\grammar;

use app\models\level\Level;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\Query as MysqlQuery;

class LevelReadRepository
{
    public function getAll()
    {
        $select = [
            'level' => "JSON_OBJECT(
                'id', lv.id,
                'title', lv.title
            )",
            'trainings' => "JSON_OBJECT(
                'title', tr.title,
                'translation', tr.translation,
                'alias', tr.alias,
                'avatar', tr.avatar
            )"
        ];

        $query = new MysqlQuery;
        $query
            ->from('level as lv')
            ->leftJoin('training AS tr', 'tr.level_id = lv.id');

        // Select
        $query->select($select);

        // Group by task ID
//        $query->groupBy('level_id');

        return $query->all();
//        return $this->_getProvider($query);
    }

    private function _getProvider($query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }
}