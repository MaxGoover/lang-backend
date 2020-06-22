<?php

namespace app\models\book\book;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "book".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $title
 * @property string $description
 * @property string $imageUrl
 * @property int $rating
 * @property int $ratingCount
 * @property string[] $level
 * @property string $youtubePlaylistId
 * @property array[] $parts
 */
class Book extends ActiveRecord
{
    public static function collectionName(): array
    {
        return [Yii::$app->params['mongoDBName'], 'book'];
    }

    public function attributes(): array
    {
        return [
            '_id',
            'title',
            'description',
            'imageUrl',
            'rating',
            'ratingCount',
            'level',
            'youtubePlaylistId',
            'parts'
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
                    '_id',
                    'title',
                    'description',
                    'level'
                ],
                'required'
            ],
            [
                ['description'],
                'string',
                'max' => Yii::$app->params['tableTextMaxLength']
            ],
            [['rating', 'ratingCount'], 'integer'],
            [
                [
                    'title',
                    'description',
                    'imageUrl',
                    'youtubePlaylistId',
                ],
                'string'
            ],
            [['level', 'parts'], 'array'],
        ];
    }
}
