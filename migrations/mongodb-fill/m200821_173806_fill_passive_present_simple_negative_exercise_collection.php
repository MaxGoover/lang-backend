<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173806_fill_passive_present_simple_negative_exercise_collection extends Migration
{
    private array $_sentences = [
        'Такие большие файлы не прикрепляются.',
        'Ничего не было найдено.',
        'Та ошибка не была исправлена.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['Such big files aren`t attached.'],
            ['Nothing was found.'],
            ['That mistake wasn`t corrected.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                1,
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
