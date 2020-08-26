<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173825_fill_passive_past_simple_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Тебя благословили делать это?',
        'Кем это было найдено?',
        'Все файлы были прикреплены?',
        'Кем был удален этот комментарий?',
        'Дети были покормлены?',
        'Сколько денег было занято?',
        'Что было сказано?',
        'Почему тот курс был укорочен?',
        'Почему это было сделано?',
        'Кто был наказан?',
        'Как это контролировалось?',
        'Кем они были увидены?',
        'Почему так много вопросов было задано?',
        'Кем были сделаны эти ошибки??',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['Were you blessed to do it?'],
            ['Who was it found by?'],
            ['Were all the files attached?'],
            ['Who was this comment deleted by?'],
            ['Were the children fed?'],
            ['How much money was borrowed?'],
            ['What was said?'],
            ['Why was that course shortened?'],
            ['Why was it done?'],
            ['Who was punished?'],
            ['How was it controlled?'],
            ['Who were they seen by?'],
            ['Why were so many questions asked?'],
            ['Who were these mistakes made by?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                2,
                3,
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
