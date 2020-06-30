<?php

namespace app\repositories\grammar;

use app\models\level\Level;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class LevelReadRepository
{
    public function getAll(): DataProviderInterface
    {
        $query = Level::find()->with('trainings')->all();
        return $this->_getProvider($query);
    }

    private function _getProvider($query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }
}