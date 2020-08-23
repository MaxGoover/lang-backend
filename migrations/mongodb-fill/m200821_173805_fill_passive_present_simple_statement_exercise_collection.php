<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173805_fill_passive_present_simple_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'Верят, что эта вещь реально помогает.',
        'Такие предложения переводятся более медленно.',
        'Эти правила очень ясно объясняются здесь.',
        'Нам часто говорят делать это.',
        'Эти деньги воруют.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['It`s believed that this thing really helps.'],
            ['Such sentences are translated more slowly.'],
            ['These rules are explained very clearly here.'],
            ['We`re often told to do it.'],
            ['This money is stolen.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
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
