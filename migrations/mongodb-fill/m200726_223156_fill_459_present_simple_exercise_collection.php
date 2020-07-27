<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200726_223156_fill_459_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Мне нужно говорить по-английски вовсе без каких-либо ошибок.',
        'Мне это нужно.',
        'Твоей маме нужно меньше работать.',
        'Мне нужно позвонить им.',
        'Мне нужно исправить эту ошибку.',
        'Ей нужно исправить эти ошибки.',
        'Мне нужна эта информация.',
        'Мне нужно правильно говорить по-английски.',
        'Тебе нужно запомнить это.',
        'Мне нужно улучшить свой английский.',
        'Мне нужно заниматься более усердно.',
        'Мне нужно позвонить ему.',
        'Мне действительно нужен английский.',
        'Мне нужно говорить по-английски без ошибок.',
        'Мы нужно решить эту проблему.',
        'Ему нужно найти хорошую работу.',
        'Мне нужно свободно говорить по-английски.',
        'Его отцу нужны деньги.',
        'Нам нужно больше информации.',
        'Ему нужно изменить свою жизнь.',
        'Мне очень нужны эти уроки.',
        'Мне очень нужно это знать.',
        'Мне нужно решить эти проблемы.',
        'Мне нужно проверить это.',
        'Мне нужен твой совет.',
        'Мне нужно выучить английский.',
        'Мне нужна эта вещь.',
        'Тебе нужно запомнить это правило.',
        'Мне нужно это сделать.',
        'Это нужно им.',
    ];

    public function up()
    {
        $translations = [
            ['I need to speak English without any mistakes at all.'],
            ['I need it.'],
            ['Your mom needs to work less.', 'Your mother needs to work less.'],
            ['I need to call them.'],
            ['I need to correct this mistake.', 'I need to fix this mistake.'],
            ['She needs to correct these mistakes.'],
            ['I need this information.'],
            ['I need to speak English correctly.'],
            ['You need to remember it.'],
            ['I need to improve my English.'],
            ['I need to study harder.'],
            ['I need to call him.'],
            ['I really need English.'],
            ['I need to speak English without mistakes.'],
            ['We need to solve this problem.'],
            ['He needs to find a good job.'],
            ['I need to speak English fluently.'],
            ['His father needs money.'],
            ['We need more information.'],
            ['He needs to change his life.'],
            ['I really need these lessons.'],
            ['I really need to know it.'],
            ['I need to solve these problem.'],
            ['I need to check it.'],
            ['I need your advice.'],
            ['I need to learn English.'],
            ['I need this thing.'],
            ['You need to remember this rule.'],
            ['I need to do it.'],
            ['They need it.'],

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
