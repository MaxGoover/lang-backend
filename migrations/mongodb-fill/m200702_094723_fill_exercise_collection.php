<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200702_094723_fill_exercise_collection extends Migration
{
    private string $_collection = 'exercise';
    private array $_exercises = [];
    private array $_sentences = [
        'Я помню это.',
        'Я понимаю тебя.',
        'Я так думаю.',
        'Мы говорим по-аглийски.',
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
            $model = new Exercise();
            $model->_id = new ObjectId();
            $model->sentence = $sentence;
            $model->translations = $translations[$key];
            $model->voice = 1;
            $model->tense_id = 1;
            $model->form = 1;
            $model->from_english = false;
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
