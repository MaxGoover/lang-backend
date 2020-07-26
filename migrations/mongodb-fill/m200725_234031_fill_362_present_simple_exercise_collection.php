<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200725_234031_fill_362_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Ты не пытаешься выучить английский.',
        'Это не работает.',
        'Я не хочу это знать.',
        'Я не согласен с тобой.',
        'Мне это не нравится.',
        'Она не хочет обсуждать это.',
        'Он там не работает. Он работает здесь',
        'Он не знает это.',
        'Это не кажется странным.',
        'Я не знаю.',
        'Она не помнит это.',
        'Он не хочет читать эти книги. Он хочет читать те книги.',
        'Я не хочу это говорить.',
        'У него нет этой информации.',
        'Я не хочу играть в компьютерные игры.',
        'Я не знаю этого человека.',
        'Я не хочу делать это прямо сейчас.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
    ];//L8 8:00

    public function up()
    {
        $translations = [
            [
                'You don`t try to learn English.',
                'You do not try to learn English.',
            ],
            [
                'It doesn`t work.',
                'It does not work.',
            ],
            [
                'I don`t want to know it.',
                'I do not want to know it.',
            ],
            [
                'I don`t agree with you.',
                'I do not agree with you.',
                'I disagree with you.',
            ],
            [
                'I don`t like it.',
                'I do not like it.',
            ],
            [
                'She doesn`t want to discuss it.',
                'She does not want to discuss it.',
            ],
            [
                'He doesn`t work there. He works here.',
                'He does not work there. He works here.',
            ],
            [
                'He doesn`t know it.',
                'He does not know it.',
            ],
            [
                'It doesn`t seem strange.',
                'It does not seem strange.',
            ],
            [
                'I don`t know.',
                'I do not know.',
            ],
            [
                'She doesn`t remember it.',
                'She does not remember it.',
            ],
            [
                'He doesn`t want to read these books. He wants to read those books.',
                'He does not want to read these books. He wants to read those books.',
            ],
            [
                'I don`t want to say it.',
                'I do not want to say it.',
            ],
            [
                'He doesn`t have this information.',
                'He does not have this information.',
            ],
            [
                'I don`t want to play computer games.',
                'I do not want to play computer games.',
            ],
            [
                'I don`t know this person.',
                'I do not know this person',
            ],
            [
                '.'
            ],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
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
