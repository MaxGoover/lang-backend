<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_174020_fill_passive_present_perfect_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Это когда-либо упоминалось?',
        'Сколько видео уже было записано?',
        'Что ещё не было сделано?',
        'Забор уже покрасили?',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['Has it ever been mentioned?'],
            ['How many videos have already been recorded?'],
            ['What hasn`t been done yet?'],
            ['Has the fence already been painted?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                7,
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
