<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173949_fill_passive_past_continuous_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'В то время, как очень важные вещи обсуждались, за ними наблюдали.',
        'Когда я позвонил ему, тот текст переводился.',
        'В то время, как они обсуждали очень важные вещи, за ними наблюдали.',
        'Когда я увидел её, та проблема обсуждалась.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['While very important things were being discussed, they were being watched.'],
            ['When I called him, that text was being translated.'],
            ['While they were discussing very important things, they were being watched.'],
            ['When I saw her, that problem was being discussed.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                5,
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
