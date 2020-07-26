<?php

namespace app\repositories\grammar;

use app\models\grammar\exercise\Exercise;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class ExerciseReadRepository
{
    public function getBy (array $conditions): DataProviderInterface
    {
        $query = Exercise::find()
            ->andWhere($conditions)
            ->orderBy('rand()')
            ->limit(10)
            ->all();
        shuffle($query);
        return $this->_getProvider($query);
    }

    private function _getProvider (array $query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }
}