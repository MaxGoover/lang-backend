<?php

namespace app\models\book;

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
 * @property array $level
 * @property string $youtubePlaylistId
 */
class Book extends ActiveRecord
{
    public static function collectionName()
    {
        return [Yii::$app->params['mongoDBName'], 'book'];
    }

    public function attributes()
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
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
            ['level', 'array'],
        ];
    }

    public static function find()
    {
        return new BookQuery(get_called_class());
    }

//    /**
//     * Get loader fields by loader type id and task type id
//     *
//     * @param int $id
//     * @param int $taskType
//     * @param int $isSearchField
//     * @return RecordLoaderFieldQuery
//     */
//    public function findByRecordLoaderTypeAndTaskTypeId(int $id, int $taskType, int $isSearchField = 0)
//    {
//        return self::find()
//            ->andWhere(['record_loader_type_id' => $id])
//            ->andWhere(['task_type_id' => $taskType])
//            ->andWhere(['is_search_field' => $isSearchField])
//            ->andWhere(['is_active' => 1])
//            ->orderBy('order');
//    }
}
