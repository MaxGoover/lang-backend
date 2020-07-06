<?php

namespace app\repositories\grammar;

use yii\db\Query as MysqlQuery;

class LevelReadRepository
{
    public function getAll()
    {
        $query = new MysqlQuery();
        $query->select([
            'level' => "JSON_OBJECT(
                'id', lv.id,
                'title', lv.title
            )",
            'trainings' => "JSON_ARRAYAGG(
                JSON_OBJECT(
                    'title', tr.title,
                    'translation', tr.translation,
                    'alias', tr.alias,
                    'avatar', tr.avatar
                )
            )"
        ]);
        $query
            ->from('training AS tr')
            ->leftJoin('level AS lv', 'lv.id = tr.level_id')
            ->groupBy('level');
        return $query->all();
    }
}