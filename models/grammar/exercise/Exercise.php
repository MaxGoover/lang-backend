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
 * @property bool $active           Активность перевода
 */
class Exercise extends ActiveRecord
{
    public static function create(
        $_id,
        $voice,
        $tenseId,
        $form,
        $fromEnglish,
        $sentence,
        $translations,
        $active = false
    )
    {
        $exercise = new static();
        $exercise->_id = $_id;
        $exercise->voice = $voice;
        $exercise->tense_id = $tenseId;
        $exercise->form = $form;
        $exercise->from_english = $fromEnglish;
        $exercise->sentence = $sentence;
        $exercise->translations = $translations;
        $exercise->active = $active;
        return $exercise;
    }

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
            'translations',
            'active',
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
                    'translations',
                    'active'
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
            [['from_english', 'active'], 'boolean'],
            ['sentence', 'string', 'length' => [3, 255]],
        ];
    }
}
