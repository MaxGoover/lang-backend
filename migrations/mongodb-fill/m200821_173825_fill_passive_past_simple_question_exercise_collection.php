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
        'Кем он был предан?',
        'Как это было сделано?',
        'Сколько денег было одолжено ему?',
        'Кого ограбили?',
        'Кем он был приглашен на эту конференцию?',
        'Почему был создан этот канал?',
        'Кем они были награждены?',
        'Кем они были увидены?',
        'Кем был создан этот канал?',
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
            ['Who was he betrayed by?'],
            ['How was it done?'],
            ['How much money was lent to him?'],
            ['Who was robbed?'],
            ['Who was he invited to this conference by?'],
            ['Why was this channel created?'],
            ['Who were they awarded by?'],
            ['Who were they seen by?'],
            ['Who was this channel created by?'],
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
