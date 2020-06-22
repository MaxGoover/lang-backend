<?php

namespace app\repositories;

use app\models\book\bookPart\BookPart;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class BookPartReadRepository
{
    public function getByBookPartId(string $bookPartId): DataProviderInterface
    {
        $query = BookPart::findOne(['bookPartId' => $bookPartId]);
        return $this->_getProvider($query);
    }

    private function _getProvider($query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}