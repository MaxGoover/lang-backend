<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_174054_fill_passive_future_perfect_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Эта книга будет прочитана к следующей неделе?',
        'Что будет сделано к тому времени, как он услышит это?',
        'Эссэ будет написано к завтрашнему?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['Will this book have been read by next week?'],
            ['What will have been done by the time he hears it?'],
            ['Will the essay have been written by tomorrow?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                9,
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
