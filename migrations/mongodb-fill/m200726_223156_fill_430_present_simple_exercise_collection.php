<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200726_223156_fill_430_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Мне нужно говорить по-английски вовсе без каких-либо ошибок.',
        'Мне это нужно.',
        'Твоей маме нужно меньше работать.',
        'Мне нужно позвонить им.',
        '.',
    ];// L10 1:55

    public function up()
    {
        $translations = [
            ['I need to speak English without any mistakes at all.'],
            ['I need it.'],
            ['Your mom needs to work less.', 'Your mother needs to work less.'],
            ['I need to call them.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                1,
                1,
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
