<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_173900_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я очень хорошо помню это.',
        'Я хожу на работу.',
        'Я здесь учусь.',
        'Я это хочу.',
        'Мы так думаем.',
        'Я там учусь.',
        'Я это знаю.',
        'Я здесь работаю.',
        'Они ходят на работу.',
        'Ты это знаешь.',
    ];

    public function up()
    {
        $translations = [
            ['I remember it very well.'],
            ['I go to work.'],
            ['I study here.'],
            ['I want it.'],
            ['We think so.'],
            ['I study there.'],
            ['I know it.'],
            ['I work here.'],
            ['They go to work.'],
            ['You know it.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = new Exercise(
                new ObjectId(),
                1,
                1,
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
