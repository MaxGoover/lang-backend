<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173840_fill_passive_future_simple_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Когда это будет доказано?',
        'Ты думаешь никто не будет наказан?',
        'Кем будет поддержан этот проект?',
        'Когда это будет забыто?',
        'Что будет предложено нам?',
        'Работа будет сделана?',
        'Когда это будет сказано?',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['When will it be proved?'],
            ['Do you think no one will be punished?'],
            ['Who will this project be supported by?'],
            ['When will it be forgotten?'],
            ['What will be offered to us?'],
            ['Will the work be done?'],
            ['When will it be said?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                3,
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
