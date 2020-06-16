<?php

namespace app\repositories;

use app\models\book\Book;
use app\models\book\BookQuery;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\mongodb\ActiveQuery;

class BookReadRepository
{
    public function getAll(): DataProviderInterface
    {
        $query = Book::find()->all();
        return $this->_getProvider($query);
    }

    private function _getProvider($query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [10, 100],
            ]
        ]);
    }
}