<?php

namespace app\models\book\bookPart;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "book_part".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $bookPartId
 * @property string $bookTitle
 * @property string $partTitle
 * @property string $youtubeId
 * @property array $content
 * @property array[] $words
 */
class BookPart extends ActiveRecord
{
    public static function collectionName(): array
    {
        return [Yii::$app->params['mongoDBName'], 'book_part'];
    }

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
