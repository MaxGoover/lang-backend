<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173924_fill_passive_present_continuous_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Что скачивается сейчас?',
        'Что говорят сейчас?',
        'В чем его обвиняют сейчас?',
        'Что обсуждается сейчас?',
        'Чьи ошибки сейчас исправляют?',
        'Чью ошибку сейчас объясняют?',
        'На кого кричат сейчас?',
        'Всё контролируется сейчас?',
        'Эти ошибки исправляют сейчас?',
        'Кому сейчас кричат?',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['What`s being downloaded now?'],
            ['What`s being said now?'],
            ['What`s he being accused of now?'],
            ['What`s being discussed now?'],
            ['Whose mistakes are being corrected now?'],
            ['Whose mistake are being explained now?'],
            ['Who is being shouted at now?'],
            ['Is everything being controlled now?'],
            ['Are these mistakes being corrected now?'],
            ['Who is being shouted to now?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                4,
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
