<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_174019_fill_passive_present_perfect_negative_exercise_collection extends Migration
{
    private array $_sentences = [
        'Это ещё не было доказано.',
        'Ключи ещё не были найдены.',
        'Это еще не было сделано.',
        'Эта вещь ещё не была сказана.',
        'Этот текст ещё не был переведён.',
        'Эти вещи ещё не были сказаны.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['It hasn`t been proved yet.'],
            ['The keys haven`t been found yet.'],
            ['It hasn`t been done yet.'],
            ['This thing hasn`t been said yet.'],
            ['This text hasn`t been translated yet.'],
            ['These things haven`t been said yet.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                7,
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
