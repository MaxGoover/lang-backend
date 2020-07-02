<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200702_132011_fill_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я говорю по-английски.',
        'Я там работаю.',
        'Они мне помогают.',
        'Мы тебя понимаем.',
        'У меня есть идея.',
        'У меня есть брат.',
        'Они ходят в школу.',
        'Вы очень хорошо говорите по-английски.',
        'У меня есть машина.',
        'Мы здесь живем.',
    ];

    public function up()
    {
        $translations = [
            ['I speak English.'],
            ['I work there.'],
            ['They help me.'],
            ['We understand you.'],
            ['I have an idea.'],
            ['I have a brother.'],
            ['They go to school.'],
            ['You speak English very well.'],
            ['I have a car.'],
            ['We live here.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = new Exercise();
            $model->_id = new ObjectId();
            $model->voice = 1;
            $model->tense_id = 1;
            $model->form = 1;
            $model->from_english = false;
            $model->sentence = $sentence;
            $model->translations = $translations[$key];
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
