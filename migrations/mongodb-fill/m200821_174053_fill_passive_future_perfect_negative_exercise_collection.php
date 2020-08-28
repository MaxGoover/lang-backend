<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_174053_fill_passive_future_perfect_negative_exercise_collection extends Migration
{
    private array $_sentences = [
        'Эта информация не будет найдена к завтрашнему.',
        '.',
        '.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['This information won`t have found by tomorrow.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                9,
                2,
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
