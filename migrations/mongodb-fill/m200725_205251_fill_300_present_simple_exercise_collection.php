<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200725_205251_fill_300_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я хочу говорить по-английски свободно и правильно.',
        'Я очень хочу это.',
        'Я хочу сделать это.',
        'Я хочу быть счастливым.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',

    ];// L6 6:38

    public function up()
    {
        $translations = [
            ['I want to speak English fluently and correctly'],
            ['I really want it'],
            ['I want to do it'],
            ['I want to be happy'],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],
            [''],

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
