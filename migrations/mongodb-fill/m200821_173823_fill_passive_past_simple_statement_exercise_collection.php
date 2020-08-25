<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173823_fill_passive_past_simple_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'Такое сильное чувство было испытано ею.',
        'Две тысячи долларов было одолжено ему.',
        'Предполагалось, что он даст эти деньги ей.',
        'Было сказано, что проблема будет решена.',
        'Второй ответ был выбран.',
        'Им поаплодировали.',
        'Было сказано, что это произойдет.',
        'Этот файл был сохранен.',
        'Все издержки были минимизированы.',
        '.',
        '.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['Such a strong feeling was experienced by her.'],
            ['Two thousand dollars were lent to him.'],
            ['He was supposed to give this money to her.'],
            ['It was said that the problem would be solved.'],
            ['The second answer was chosen.'],
            ['They were applauded.'],
            ['It was said that it would happen.'],
            ['This file was saved.'],
            ['All the costs were minimized.'],
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
                2,
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
