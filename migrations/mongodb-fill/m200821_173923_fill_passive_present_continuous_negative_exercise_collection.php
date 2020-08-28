<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173923_fill_passive_present_continuous_negative_exercise_collection extends Migration
{
    private array $_sentences = [
        'Эта ситуация не контролируется сейчас.',
        'Эти файлы не скачиваются сейчас.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['This situation isn`t being controlled now.'],
            ['These files aren`t being downloaded now.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                4,
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
