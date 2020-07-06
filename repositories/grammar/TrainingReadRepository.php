<?php

namespace app\repositories\grammar;

use app\models\grammar\training\Training;
use app\repositories\NotFoundException;
use yii\db\ActiveRecord;

class TrainingReadRepository
{
    public function getByAlias(string $alias): ActiveRecord
    {
        return $this->_getBy(['alias' => $alias]);
    }

    private static function _getBy(array $condition): ActiveRecord
    {
        if (!$training = Training::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Training not found');
        }
        return $training;
    }
}