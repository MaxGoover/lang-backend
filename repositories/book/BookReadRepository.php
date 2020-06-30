<?php

namespace app\repositories\book;

use app\models\book\book\Book;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

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