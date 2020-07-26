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
        'Он не хочет попытаться найти хорошую работу.',
        'Он не пытается найти хорошую работу.',
        'Я не хочу жить в этой стране.',
        'Мой друг так не думает.',
        'Я не хочу рассказывать тебе об этой проблеме.',
        'Я не хочу там учиться.',
        'Мы не хотим жить в другом месте.',
        'Это не кажется полезным.',
        'Они мне не помогают.',
        'Я не хочу говорить тебе эту вещь.',
        'Я не хочу думать об этом.',
        'Я не понимаю этих людей.',
        'Мы это не понимаем.',
        'Я не хочу это обсуждать.',
        'У него нет машины.',
        'Я не хочу пить.',
        'Я не хочу жить в том городе.',
        'Мне это не помогает.',
        'То предложение не кажется странным.',
        'Его начальник не говорит по-английски свободно.',
        'Мои родители не обсуждают это.',
        'Эти вещи меня не привлекают.',
        'Те вещи не кажутся странными.',
        'Его сын не хочет становиться врачом.',
        'Наш учитель не верит нам.',
        'Мой партнер не знает его.',
        'Моему другу не нравится эта идея.',
        'Она думает, деньги не делают людей счастливыми.',
        'Этот человек не пытается изменить свою жизнь.',
        'Мой начальник не видит её.',
        'Меня эта вещь не привлекает.',
        'Мои друзья не рекомендуют этот отель.',
        'Моя сестра не знает этого человека.',
        'Мой брат не хочет думать о своем будущем.',
        'Я со своим другом не звоню им.',
        'Мой друг так не думает.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
        '.',
    ];//L9 10:00

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
                'I don`t want to do it right now.',
                'I do not want to do it right now.'
            ],
            [
                'He doesn`t want to try to find a good job.',
                'He does not want to try to find a good job.',
            ],
            [
                'He doesn`t try to find a good job.',
                'He does not try to find a good job.',
            ],
            [
                'I don`t want to live in this country.',
                'I do not want to live in this country.',
            ],
            [
                'My friend doesn`t think so.',
                'My friend does not think so.',
            ],
            [
                'I don`t want to tell you about this problem.',
                'I do not want to tell you about this problem.',
            ],
            [
                'I don`t want to study there.',
                'I do not want to study there.',
            ],
            [
                'We don`t want to live in another place.',
                'We do not want to live in another place.',
            ],
            [
                'It doesn`t seem useful.',
                'It does not seem useful.',
            ],
            [
                'They don`t help me.',
                'They do not help me.',
            ],
            [
                'I don`t want to tell you this thing.',
                'I do not want to tell you this thing.',
            ],
            [
                'I don`t want to think about it.',
                'I do not want to think about it.',
            ],
            [
                'I don`t understand these people.',
                'I do not understand these people.',
            ],
            [
                'We don`t understand it.',
                'We do not understand it.',
            ],
            [
                'I don`t want to discuss it.',
                'I do not want to discuss it.',
            ],
            [
                'He doesn`t have a car.',
                'He does not have a car.',
            ],
            [
                'I don`t want to drink.',
                'I do not want to drink.',
            ],
            [
                'I don`t want to live in that city.',
                'I do not want to live in that city.',
            ],
            [
                'It doesn`t help me.',
                'It does not help me.',
            ],
            [
                'That offer doesn`t seem strange.',
                'That offer does not seem strange.',
            ],
            [
                'His boss doesn`t speak English fluently.',
                'His boss does not speak English fluently.',
            ],
            [
                'My parents don`t discuss it.',
                'My parents do not discuss it.',
            ],
            [
                'These things don`t attract me.',
                'These things do not attract me.',
            ],
            [
                'Those things don`t seem strange.',
                'Those things do not seem strange.',
            ],
            [
                'His son doesn`t want to become a doctor.',
                'His son does not want to become a doctor.',
            ],
            [
                'Our teacher doesn`t believe us.',
                'Our teacher does not believe us.',
            ],
            [
                'My partner doesn`t know him.',
                'My partner does not know him.',
            ],
            [
                'My friend doesn`t like this idea.',
                'My friend does not like this idea.',
            ],
            [
                'She thinks money doesn`t make people happy.',
                'She thinks money does not make people happy.',
            ],
            [
                'This person doesn`t try to change his life.',
                'This person does not try to change his life.',
            ],
            [
                'My boss doesn`t boss see her.',
                'My boss does not boss see her.',
            ],
            [
                'This thing doesn`t attract me.',
                'This thing does not attract me.',
            ],
            [
                'My friends don`t recommend this hotel.',
                'My friends do not recommend this hotel.',
            ],
            [
                'My sister doesn`t know this person.',
                'My sister does not know this person.',
            ],
            [
                'My brother doesn`t want to think about his future.',
                'My brother does not want to think about his future.',
            ],
            [
                'My friend and I don`t call them.',
                'My friend and I do not call them.',
            ],
            [
                'My friend doesn`t think so.',
                'My friend does not think so.',
            ],
            [
                '.',
            ],
            [
                '.',
            ],[
                '.',
            ],[
                '.',
            ],[
                '.',
            ],[
                '.',
            ],[
                '.',
            ],
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
