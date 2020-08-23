<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173840_fill_passive_future_simple_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Когда это будет доказано?',
        '?',
        '?',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['When will it be proved?'],
            ['?'],
            ['?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                3,
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
