<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_195428_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Она говорит по-английски очень хорошо.',
        'Он так думает.',
        'Он живет в этой стране.',
        'Она читатет английские книги.',
        'Я люблю тебя.',
        'Это действительно помогает мне.',
        'Она видит эту ошибку.',
        'Она мне помогает.',
        'Он чувствует себя счастливым.',
        'Это кажется интересным.',
    ];

    public function up()
    {
        $translations = [
            ['She speaks English very well.'],
            ['He thinks so.'],
            ['He lives in this country.'],
            ['She reads English books.'],
            ['I love you.'],
            ['It really helps me.'],
            ['She sees this mistake.'],
            ['She helps me.'],
            ['He feels happy.'],
            ['It seems interesting.'],
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
