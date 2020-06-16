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
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return [Yii::$app->params['mongoDBName'], 'book'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'task_type_id',
            'record_loader_type_id',
            'record_loader_field_type_id',
            'alias',
            'title',
            'description',
            'default_title',
            'value',
            'icon',
            'visibility',
            'php_date_format',
            'js_date_format',
            'order',
            'is_search_field',
            'is_active',
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
                    'task_type_id',
                    'record_loader_type_id',
                    'record_loader_field_type_id',
                    'alias',
                    'title',
                    'visibility',
                    'order',
                    'is_search_field',
                    'is_active',
                ],
                'required'
            ],
            [
                [
                    'default_title',
                    'value',
                    'icon',
                    'php_date_format',
                    'js_date_format',
                ],
                'safe'
            ],
            [
                ['description'],
                'string',
                'max' => Yii::$app->params['tableTextMaxLength']
            ],
            [
                [
                    'task_type_id',
                    'record_loader_type_id',
                    'record_loader_field_type_id',
                    'order',
                    'is_search_field',
                    'is_active'
                ],
                'integer'
            ],
            [
                [
                    'task_type_id',
                    'record_loader_type_id',
                    'record_loader_field_type_id',
                    'order',
                    'is_search_field',
                    'is_active'
                ],
                'filter',
                'filter' => function ($value) {
                    return (int)$value;
                }
            ],
            [
                ['visibility'],
                'boolean'
            ],
            [
                ['visibility'],
                'filter',
                'filter' => function ($value) {
                    return (bool)$value;
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id'                         => Yii::t('record', 'ID'),
            'task_type_id'                => Yii::t('record', 'Task Type ID'),
            'record_loader_type_id'       => Yii::t('record', 'Record Loader Type ID'),
            'record_loader_field_type_id' => Yii::t('record', 'Record Loader Field Type ID'),
            'alias'                       => Yii::t('record', 'Alias'),
            'title'                       => Yii::t('record', 'Title'),
            'description'                 => Yii::t('record', 'Description'),
            'default_title'               => Yii::t('record', 'Default Title'),
            'value'                       => Yii::t('record', 'Value'),
            'icon'                        => Yii::t('record', 'Icon'),
            'visibility'                  => Yii::t('record', 'Visibility'),
            'php_date_format'             => Yii::t('record', 'Php Date Format'),
            'js_date_format'              => Yii::t('record', 'Js Date Format'),
            'order'                       => Yii::t('record', 'Order'),
            'is_search_field'             => Yii::t('record', 'Is Search Field'),
            'is_active'                   => Yii::t('record', 'Is Active'),
        ];
    }

    /**
     * Get loader fields by loader type id and task type id
     *
     * @param int $id
     * @param int $taskType
     * @param int $isSearchField
     * @return RecordLoaderFieldQuery
     */
    public function findByRecordLoaderTypeAndTaskTypeId(int $id, int $taskType, int $isSearchField = 0)
    {
        return self::find()
            ->andWhere(['record_loader_type_id' => $id])
            ->andWhere(['task_type_id' => $taskType])
            ->andWhere(['is_search_field' => $isSearchField])
            ->andWhere(['is_active' => 1])
            ->orderBy('order');
    }

    /**
     * {@inheritdoc}
     * @return RecordLoaderFieldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecordLoaderFieldQuery(get_called_class());
    }
}
