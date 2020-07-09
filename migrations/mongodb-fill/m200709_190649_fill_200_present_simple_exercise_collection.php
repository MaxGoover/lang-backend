<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200709_190649_fill_200_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Я помню это.',
        'Она чувствует себя такой счастливой.',
        'У нее есть интересные идеи.',
        'Он часто ходит в кино.',
        'Он иногда хочет это сделать.',
        'Она скучает по тебе.',
        'Он пытается это сделать.',
        'Она хочет пойти в парк.',
        'У него есть деньги.',
        'У нее есть машина.',
        'Он пытается мне помочь.',
        'У него есть доллары.',
        'У него есть предложение.',
        'Он преподает английский.',
        'Она пытается выучить английский.',
        'У него есть дом.',
        'Она делает это очень хорошо.',
        'Он часто играет в компьютерные игры.',
        'Она пытется это понять.',
        'Она часто ходит в парк.',
        'Я все вижу.',
        'Моя сестра живет там.',
        'Этот урок кажется интересным.',
        'Этот урок мне помогает.',
        'Я все понимаю.',
        'Мои родители знают это.',
        'Её брат часто говорит это.',
        'Мой начальник всегда говорит это.',
        'Его уроки кажутся очень полезными.',
        'Мой брат хочет это.',
        'У его отца есть машина.',
        'Мои родители хотят сделать это.',
        'Ваши уроки действительно помогают.',
        'Моя сестра учится там.',
        'Эти уроки помогают мне.',
        'Они всё знают.',
        'Мой брат пытается это сделать.',
        'Их идеи кажутся очень интересными.',
        'Мой начальник обычно проверяет всю информацию.',
        'Моя сестра живет в этом месте.',
        'У моего друга есть машина.',
        'У него есть компания. Её прибыль кажется такой большой.',
        'Мой начальник всё знает.',
        'Мой начальник читает все документы.',
        'Эти уроки кажутся очень полезными.',
        'Это предложение выглядит интересным.',
        'У этой компании есть деньги.',
        'Эти уроки действительно помогают. Я чувствую это',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['I remember it.'],
            ['She feels so happy.'],
            ['She has interesting ideas.'],
            ['He often goes to the cinema.'],
            ['He sometimes wants to do it.'],
            ['She misses you.'],
            ['He tries to do it.'],
            ['He has money.'],
            ['She has a car.'],
            ['He tries to help me.'],
            ['He has dollars.'],
            ['He has an offer.'],
            ['He teaches English.'],
            ['She tries to learn English.'],
            ['He has a house.'],
            ['She does it very well.'],
            ['He often plays computer games.'],
            ['She tries to understand it.'],
            ['She often goes to the park.'],
            ['I see everything.'],
            ['My sister lives there.'],
            ['This lesson seems interesting.'],
            ['This lesson helps me.'],
            ['I understand everything.'],
            ['My parents know it.'],
            ['Her brother often says it.'],
            ['My boss always says it.'],
            ['His lessons seem very useful.'],
            ['My brother wants it.'],
            ['His father has a car.'],
            ['My parents want to do it.'],
            ['Your lessons really help.'],
            ['My sister studies there.'],
            ['These lessons help me.'],
            ['They know everything.'],
            ['My brother tries to do it.'],
            ['Their ideas seem very interesting.'],
            ['My boss usually checks all the information.'],
            ['My sister lives in this place.'],
            ['My friend has a car.'],
            ['He has a company. Its profit seems so big'],
            ['My boss knows everything.'],
            ['My boss reads all the documents.'],
            ['These lessons seem very useful.'],
            ['This offer looks interesting.'],
            ['This company has money'],
            ['These lessons really help. I feel it.'],
            ['.'],
//8 55 l3
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
