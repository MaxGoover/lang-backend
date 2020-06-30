<?php

namespace app\models\level;

use app\models\training\Training;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "level".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $code
 */
class Level extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%level}}';
    }

    public function getTrainings(): ActiveQuery
    {
        return $this->hasMany(Training::class, ['level_id' => 'id']);
    }
}
