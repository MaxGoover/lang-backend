<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_175316_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я работаю.',
        'Я живу в этой стране.',
        'Мы живем в России.',
        'У меня есть сестра.',
        'Ты это видишь.',
        'Я хожу в школу.',
        'Я понимаю.',
        'Мы живем в этой стране.',
        'Я это вижу.',
        'Это выглядит странно.',
    ];

    public function up()
    {
        $translations = [
            ['I work.'],
            ['I live in this country.'],
            ['We live in Russia.'],
            ['I have a sister.'],
            ['You see it.'],
            ['I go to school.'],
            ['I understand.'],
            ['We live in this country.'],
            ['I see it.'],
            ['It looks strange.'],
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
