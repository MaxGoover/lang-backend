<?php

namespace app\models\tense;

use app\models\training\Training;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tense".
 *
 * @property int $id
 * @property string $title
 * @property string $translation
 */
class Tense extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%tense}}';
    }
}
