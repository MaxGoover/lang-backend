<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173838_fill_passive_future_simple_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'Этот проект будет закончен скоро.',
        'Я думаю, меня будут критиковать.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['This project will be finished  soon.'],
            ['I think I`ll be criticized.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                3,
                1,
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
