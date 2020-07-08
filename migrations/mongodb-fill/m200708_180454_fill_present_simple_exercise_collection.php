<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_180454_fill_present_simple_exercise_collection extends \yii\mongodb\Migration
{
    private array $_sentences = [
        'Он читает по-английски.',
        'Она помнит это.',
        'Это выглядит интересно.',
        'Он работает очень усердно.',
        'Ты работаешь очень усердно.',
        'Он мне помогает.',
        'Он очень хорошо понимает тебя.',
        'Он также работает здесь.',
        'Это действительно происходит.',
        'Она работает очень усердно.',
    ];

    public function up()
    {
        $translations = [
            ['He reads in English.'],
            ['She remembers it.'],
            ['It looks interesting.'],
            ['He works very hard.'],
            ['You work very hard.'],
            ['He helps me.'],
            ['He understands you very well.'],
            ['He also works here.'],
            ['It really happens.'],
            ['She works very hard.'],
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
