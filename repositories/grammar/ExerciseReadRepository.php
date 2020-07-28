<?php

namespace app\repositories\grammar;

use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\mongodb\Collection;
use Yii;

class ExerciseReadRepository
{
    public function getByConditions (array $conditions): DataProviderInterface
    {
        /* @var Collection $collection */
        $collection = Yii::$app->mongodb->getCollection('exercise');
        $query = $collection->aggregate(
            [
                ['$match' => $conditions],
                ['$sample' => ['size' => 10]]
            ]
        );
        return $this->_getProvider($query);
    }

    private function _getProvider (array $query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }
}