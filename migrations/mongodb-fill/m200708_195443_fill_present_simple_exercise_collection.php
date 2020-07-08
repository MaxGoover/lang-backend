<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_195443_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я чувствую себя счастливым.',
        'Мы хотим это.',
        'Она хочет больше практики.',
        'Она читает по-английски.',
        'Он любит тебя.',
        'Он знает больше.',
        'Я хочу больше практики.',
        'Он хочет сделать это.',
        'Она смотрит телевизор.',
        'У нее есть кошка.',
    ];

    public function up()
    {
        $translations = [
            ['I feel happy.'],
            ['We want it.'],
            ['She wants more practice.'],
            ['She reads in English.'],
            ['He loves you.'],
            ['He knows more.'],
            ['I want more practice.'],
            ['He wants to do it.'],
            ['She watches TV.'],
            ['She has a cat.'],
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
