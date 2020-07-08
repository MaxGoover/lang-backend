<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200702_094723_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я помню это.',
        'Я понимаю тебя.',
        'Я так думаю.',
        'Мы говорим по-английски.',
        'Я знаю это очень хорошо.',
        'Ты мне помогаешь.',
        'Я живу в России.',
        'Я очень хорошо понимаю тебя.',
        'Я живу в этом городе.',
        'Мы помним это.',
    ];

    public function up()
    {
        $translations = [
            ['I remember it.'],
            ['I understand you.'],
            ['I think so.'],
            ['We speak English.'],
            ['I know it very well.'],
            ['You help me.'],
            ['I live in Russia.'],
            ['I understand you very well.'],
            ['I live in this city.'],
            ['We remember it.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
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
