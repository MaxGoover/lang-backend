<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_174018_fill_passive_present_perfect_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'Эта книга никогда не была опубликована.',
        'Как это только что было сказано.',
        'Нас только что проинформировали.',
        'Решение только что было одобрено.',
        'Этот комментарий только что был удален.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['This book has never been published.'],
            ['As it`s just been said.'],
            ['We`ve just been informed.'],
            ['The decision has just been approved.'],
            ['This comment has just been deleted.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                7,
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
