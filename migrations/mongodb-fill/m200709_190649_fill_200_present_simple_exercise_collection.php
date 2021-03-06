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
        'Она пытается это понять.',
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
        'У меня есть семья.',
        'Мы часто это делаем.',
        'Ты всегда это говоришь.',
        'Они часто ходят в кино.',
        'Он знает эту вещь.',
        'Она видит эту ошибку.',
        'Это выглядит так интересно.',
        'Я вижу эту ошибку.',
        'Я понимаю того человека.',
        'Я понимаю тех людей.',
        'Он ходит в школу.',
        'Она всегда делает это очень хорошо.',
        'Мой друг так думает.',
        'Мой друг думает одинаково.',
        'Наш начальник это знает.',
        'Все твои идеи кажутся очень интересными.',
        'Их предложение кажется действительно странным.',
        'Его идея кажется очень интересной.',
        'Ее слова кажутся странными.',
        'Наша мама думает одинаково.',
        'Она видит ту ошибку.',
        'Так компания очень богатая. Мы видим ее успех',
        'Мой друг живет в том городе.',
        'Мой брат учится там.',
        'Эта вещь выглядит так странно.',
        'Я пытаюсь выучить английский.',
        'Он часто играет в компьютерные игры.',
        'Его предложение кажется очень странным.',
        'Его мама преподает английский.',
        'Я читаю по-английски.',
        'Мой друг пытается это понять.',
        'Она пытается найти работу.',
        'Ты занимаешься очень усердно.',
        'Эта вещь кажется очень интересной.',
        'Он читает по-английски.',
        'У моих друзей есть идея.',
        'У тебя очень интересные идеи.',
        'Наш начальник так думает.',
        'Я понимаю этого человека.',
        'Я действительно чувствую свой прогресс.',
        'Я хочу улучшить свою грамматику.',
        'Я хочу пойти туда еще раз.',
        'Она хочет жить в другом месте.',
        'Она хочет сделать это.',
        'Я хочу знать это.',
        'Я хочу говорить по-английски без ошибок.',
        'Она хочет увидеть тебя прямо сейчас.',
        'Я хочу этот компьютер.',
        'Я хочу это платье.',
        'Я хочу хорошую машину.',
        'Он хочет купить эту вещь.',
        'Я хочу снова пойти туда.',
        'Я хочу иметь хорошую работу.',
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
            ['She wants to go the park.'],
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
            ['I have a family.'],
            ['We often do it.'],
            ['You always say it.'],
            ['They often go to the cinema.'],
            ['He knows this thing.'],
            ['She sees this mistake.'],
            ['It looks so interesting.'],
            ['I see this mistake.'],
            ['I understand that person.'],
            ['I understand those people.'],
            ['He goes to school.'],
            ['She always does it very well.'],
            ['My friend thinks so.'],
            ['My friend thinks the same.'],
            ['Our boss knows it.'],
            ['All your ideas seem very interesting.'],
            ['Their offer seems really strange.'],
            ['His idea seems very interesting.'],
            ['Her words seem strange.'],
            ['Our mom thinks the same.', 'Our mother thinks the same.'],
            ['She sees that mistake.'],
            ['That company is very rich. We see its success.'],
            ['My friend lives in that city.'],
            ['My brother studies there.'],
            ['This thing looks so strange.'],
            ['I try to learn English.'],
            ['He often plays computer games.'],
            ['His offer seems very strange.'],
            ['His mom teaches English.', 'His mother teaches English'],
            ['I read in English.'],
            ['My friend tries to understand it.'],
            ['She tries to find a job.'],
            ['You study very hard.'],
            ['This thing seems very interesting.'],
            ['He reads in English.'],
            ['My friends have an idea.'],
            ['You have very interesting ideas.'],
            ['Our boss thinks so.'],
            ['I understand this person.'],
            ['I really feel my progress.'],
            ['I want to improve my grammar.'],
            ['I want to go there one more time.'],
            ['She wants to live in another place.'],
            ['She wants to do it.'],
            ['I want to know it.'],
            ['I want to speak English without mistakes.'],
            ['She wants to see you right now.'],
            ['I want this computer.'],
            ['I want this dress.'],
            ['I want a good car.'],
            ['He wants to buy this thing.'],
            ['I want to go there again.'],
            ['I want to have a good job.'],
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
