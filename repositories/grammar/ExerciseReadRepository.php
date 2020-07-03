<?php

namespace app\repositories\grammar;

use app\models\grammar\exercise\Exercise;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class ExerciseReadRepository
{
    public function getByTenseAndVoice (): DataProviderInterface
    {
        $query = Exercise::find()
            ->andWhere(['alias' => $alias])
            ->orderBy('RAND()')
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