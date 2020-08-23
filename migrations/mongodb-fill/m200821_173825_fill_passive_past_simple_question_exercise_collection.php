<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173825_fill_passive_past_simple_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Тебя благословили делать это?',
        'Кем это было найдено?',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['Were you blessed to do it?'],
            ['Who was it found by?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                2,
                3,
                false,
                $sentence,
                $translations[$key],
                true
            );
            $model->save();
        }
    }

    public function down()
    {
        Exercise::deleteAll([
            'in',
            'sentence',
            $this->_sentences
        ]);
    }
}
