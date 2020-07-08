<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_195438_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Он хочет большего.',
        'Он также здесь работает.',
        'Они учатся очень усердно.',
        'Он действительно так думает.',
        'Мне это помогает.',
        'Это случается.',
        'Она живет в этом месте.',
        'Она хочет большего.',
        'Он хочет больше практики.',
        'Он живет там.',
    ];

    public function up()
    {
        $translations = [
            ['He wants more.'],
            ['He also works here.'],
            ['They study very hard.'],
            ['He really thinks so.'],
            ['It helps me.'],
            ['It happens.'],
            ['She lives in this place.'],
            ['She wants more.'],
            ['He wants more practice.'],
            ['He lives there.'],
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
