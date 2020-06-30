<?php

namespace app\models\training\training;

use app\models\level\level\Level;
use app\models\tense\tense\Tense;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "training".
 *
 * @property int $id
 * @property int $level_id
 * @property int $tense_id
 * @property string $title
 * @property string $translation
 * @property string $alias
 * @property string $avatar
 */
class Training extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%training}}';
    }

    public function getLevel(): ActiveQuery
    {
        return $this->hasOne(Level::class, ['id' => 'level_id']);
    }

    public function getTense(): ActiveQuery
    {
        return $this->hasOne(Tense::class, ['id' => 'tense_id']);
    }
}
