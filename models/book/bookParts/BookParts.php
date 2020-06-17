<?php

namespace app\models\book\bookParts;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "book_parts".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $bookPartId
 * @property string $bookTitle
 * @property string $partTitle
 * @property string $youtubeId
 * @property array $content
 * @property array[] $words
 */
class BookParts extends ActiveRecord
{
    public static function collectionName()
    {
        return [Yii::$app->params['mongoDBName'], 'book_parts'];
    }

//    public static function find()
//    {
//        return new BookPartsQuery(get_called_class());
//    }

    public function attributes(): array
    {
        return [
            '_id',
            'bookPartId',
            'bookTitle',
            'partTitle',
            'youtubeId',
            'content',
            'words',
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
                    '_id',
                    'bookPartId',
                    'bookTitle',
                    'partTitle',
                ],
                'required'
            ],
            [
                [
                    'bookPartId',
                    'bookTitle',
                    'partTitle',
                    'youtubeId',
                ],
                'string'
            ],
            [['content', 'words'], 'array'],
        ];
    }
}
