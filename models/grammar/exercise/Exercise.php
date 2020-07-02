<?php

namespace app\models\grammar\exercise;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "exercise".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property int $voice             Залог (1 - активный, 2- пассивный)
 * @property int $tense_id          Время (1-12)
 * @property int $form              Форма (1 - утвердительная, 2 - отрицательная, 3 - вопросительная)
 * @property bool $from_english     Перевод с английского
 * @property string $sentence       Предложение
 * @property array $translations    Варианты переводов ($translations[0] - основной перевод, остальные дополнительные)
 */
class Exercise extends ActiveRecord
{
    public static function collectionName(): array
    {
        return [Yii::$app->params['mongoDBName'], 'exercise'];
    }

    public function attributes(): array
    {
        return [
            '_id',
            'voice',
            'tense_id',
            'form',
            'from_english',
            'sentence',
            'translations'
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
                    '_id',
                    'voice',
                    'tense_id',
                    'form',
                    'from_english',
                    'sentence',
                    'translations'
                ],
                'required'
            ],
            [
                [
                    'voice',
                    'tense_id',
                    'form',
                ],
                'integer'
            ],
            ['from_english', 'boolean'],
            ['sentence', 'string', 'length' => [3, 255]],
        ];
    }
}
