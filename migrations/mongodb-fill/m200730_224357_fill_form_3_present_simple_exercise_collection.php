<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200730_224357_fill_form_3_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Ты все помнишь?',
        'Они поддерживают нас?',
        'Тебе нравится это?',
        'Ты хочешь учиться лучше?',
        'Ты часто пользуешься интернетом?',
        'Ты часто ходишь в спортзал?',
        'Ты поддерживаешь его?',
        'Ты ходишь в школу?',
        'У нас достаточно знаний?',
        'Ты хочешь знать свои ошибки?',
        'Мы показываем хорошие результаты?',
        'Тебе нужно решить эту проблему прямо сейчас?',
        'У тебя достаточно денег?',
        'У нас достаточно практики?',
        'Ты поддерживаешь его?',
        'Тебе нравится это платье?',
        'Они согласны с нами?',
        'Ты часто ходишь туда?',
        'Ты поддерживаешь меня?',
        'Вам нравится то предложение?',
        'Ты часто слушаешь музыку?',
        'Ты ходишь на работу?',
        'Ты согласен с ним?',
        'Ты пытаешься улучшить этот результат?',
        'У тебя есть свободное время?',
        'Ты меня понимаешь?',
        'Ты поддерживаешь это решение?',
        'Ты работаешь над своими ошибками?',
        'Тебе действительно нравится эта идея?',
        'Вам нужно больше денег?',
        'Ты согласен с ними?',
        'Я делаю ошибки?',
        'Ты помнишь это?',
        'Ты согласен с ней?',
        'Ты знаешь об этой проблеме?',
        'Ты часто делаешь это?',
        'Тебе нужна помощь?',
        'У меня достаточно денег?',
        'Ты согласен со мной?',
        'Ты часто посещаешь это место?',
        'Тебе нужен мой совет?',
        'Они поддерживают это решение?',
        'Они видят свои ошибки?',
        'Ты часто звонишь ему?',
        'Ему нравится это?',
        'Он ненавидит это?',
        'Он хочет жить за границей?',
        'Это кажется скучным?',
        'Она все говорит ему?',
        'Он там живет?',
        'Ей нужно прийти туда?',
        'Ей нужно прийти в то место?',
        'Ей действительно нравится это?',
        'Она часто слушает радио?',
        'Это кажется интересным?',
        'Он все игнорирует?',
        'Он пытается найти новую работу?',
        'Ему нравится этот проект?',
        'Ей нравится эта профессия?',
        'Он платит за это?',
        'Ей нужно позвонить ему?',
        'Она часто это говорит?',
        'Он часто говорит по-английски?',
        'Он часто говорит тебе эти вещи?',
        'Это иногда происходит?',
        'Она хочет поехать за границу?',
        'Она часто пользуется этим?',
        'Он ищет работу?',
        'Он ненавидит эту вещь?',
        'Он хочет работать в другом месте?',
        'Это действительно помогает тебе?',
        'Он игнорирует ее слова?',
        'Он помнит все эти правила?',
        'Это часто происходит?',
        'Он часто думает об этом?',
        'Он часто смотрит телевизор?',
        'Это выглядит странно?',
        'Он часто слышит это?',
        'Она преподает английский?',
        'Он всегда платит за нее?',
        'Она игнорирует это иногда?',
        'Эта вещь кажется важной?',
        'Твои родители понимают это?',
        'Этот экзамен кажется очень сложным?',
        'Этот студент показывает блестящие результаты?',
        'Твоя мать хочет сказать ему всю правду?',
        'Тот урок кажется скучным?',
        'Этот урок кажется полезным?',
        'Её парень хочет поехать за границу?',
        'Этот учитель объясняет все очень хорошо?',
        'Твоему отцу нужно это?',
        'Эти вещи кажутся неважными?',
        'Твой друг согласен с тобой?',
        'Твоему другу нравится эта идея?',
        'Эта информация кажется бесполезной?',
        'Этот канал помогает тебе?',
        'Тот тест кажется очень легким?',
        'Их начальник знает всю правду?',
        'Твой учитель видит это?',
        'Твои друзья согласны с тобой?',
        'Его девушка понимает это?',
        'Эти студенты показывают отличные результаты?',
        'Эта информация кажется неважной?',
        'Тот студент делает ошибки?',
        'Твои друзья всегда поддерживают тебя?',
        'Этот канал кажется очень интересным?',
        'Эти уроки помогают тебе?',
        'Этот результат мотивирует тебя?',
        'Эти результаты мотивируют тебя?',
        'Этот человек кажется очень хорошим?',
        'Те вещи интересуют его?',
        'Ей нравится эта идея?',
        'Деньги интересуют его?',
        'Эта женщина работает в другом месте?',
        'Она хочет решить эту проблему?',
        'Его слова мотивируют её?',
        'Твой отец приходит домой поздно?',
        'Этот отель выглядит очень хорошо?',
        'Ей нравится это место?',
        'Это кажется действительно интересным?',
        'Он пытается изменить это?',
        'Они согласны с этим?',
        'Кого ты знаешь?',
        'Когда ты ходишь на работу?',
        'Где они проводят время вместе?',
        'Почему ты согласен с ним?',
        'В какого рода компьютерные игры они играют?',
        'Во сколько ты ложишься спать?',
        'Что ты хочешь сказать?',
        'Что ты хочешь сделать?',
        'Как часто ты ходишь в спортзал?',
        '?',
        '?',
        '?',
        '?',
        '?',
    ];// L18 3:57

    public function up()
    {
        $translations = [
            ['Do you remember everything?'],
            ['Do they support us?'],
            ['Do you like it?'],
            ['Do you want to study better?'],
            ['Do you often use the internet?'],
            ['Do you often go to the gym?'],
            ['Do you support him?'],
            ['Do you go to school?'],
            ['Do we have enough knowledge?'],
            ['Do you want to know your mistakes?'],
            ['Do we show good results?'],
            ['Do you need to solve this problem right now?'],
            ['Do you have enough money?'],
            ['Do we have enough practice?'],
            ['Do you support him?'],
            ['Do you like this dress?'],
            ['Do they agree with us?'],
            ['Do you often go there?'],
            ['Do you support me?'],
            ['Do you like that offer?'],
            ['Do you often listen to music?'],
            ['Do you go to work?'],
            ['Do you agree with him?'],
            ['Do you try to improve this result?'],
            ['Do you have free time?'],
            ['Do you understand me?'],
            ['Do you support this decision?'],
            ['Do you work on your mistakes?'],
            ['Do you really like this idea?'],
            ['Do you need more money?'],
            ['Do you agree with them?'],
            ['Do I make mistakes?'],
            ['Do you remember it?'],
            ['Do you agree with her?'],
            ['Do you know about this problem?'],
            ['Do you often do it?'],
            ['Do you need help?'],
            ['Do I have enough money?'],
            ['Do you agree with me?'],
            ['Do you often visit this place?'],
            ['Do you need my advice?'],
            ['Do they support this decision?'],
            ['Do they see their mistakes?'],
            ['Do you often call him?'],
            ['Does he like it?'],
            ['Does he hate it?'],
            ['Does he want to live abroad?'],
            ['Does it seem boring?'],
            ['Does she tell him everything?'],
            ['Does he live there?'],
            ['Does she need to come there?'],
            ['Does she need to come to that place?'],
            ['Does she really like it?'],
            ['Does she often listen to the radio?'],
            ['Does it seem interesting?'],
            ['Does he ignore everything?'],
            ['Does he try to find a new job?'],
            ['Does he like this project?'],
            ['Does she like this profession?'],
            ['Does he pay for it?'],
            ['Does she need to call him?'],
            ['Does she often say it?'],
            ['Does he often speak English?'],
            ['Does he often tell you these things?'],
            ['Does it sometimes happen?'],
            ['Does she want to go abroad?'],
            ['Does she often use it?'],
            ['Does he look for a job?'],
            ['Does he hate this thing?'],
            ['Does he want to work in another place?'],
            ['Does it really help you?'],
            ['Does he ignore her words?'],
            ['Does he remember all these rules?'],
            ['Does it often happen?'],
            ['Does he often think about it?'],
            ['Does he often watch TV?'],
            ['Does it look strange?'],
            ['Does he often hear it?'],
            ['Does she teach English?'],
            ['Does he always pay for her?'],
            ['Does she ignore it sometimes?'],
            ['Does this thing seem important?'],
            ['Do your parents understand it?'],
            ['Does this exam seem very difficult?'],
            ['Does this student show brilliant results?'],
            ['Does your mother want to tell him all the truth?'],
            ['Does that lesson seem boring?'],
            ['Does this lesson seem useful?'],
            ['Does her boyfriend want to go abroad?'],
            ['Does this teacher explain everything very well?'],
            ['Does your father need it?'],
            ['Do these things seem unimportant?'],
            ['Does your friend agree with you?'],
            ['Does your friend like this idea?'],
            ['Does this information seem useless?'],
            ['Does this channel help you?'],
            ['Does that test seem very easy?'],
            ['Does their boss know all the truth?'],
            ['Does your teacher see it?'],
            ['Do your friends agree with you?'],
            ['Does his girlfriend understand it?'],
            ['Do these students show excellent results?'],
            ['Does this information seem unimportant?'],
            ['Does that student make mistakes?'],
            ['Do your friends always support you?'],
            ['Does this channel seem very interesting?'],
            ['Do these lessons helps you?'],
            ['Does this result motivate you?'],
            ['Do these results motivate you?'],
            ['Does this person seem very good?'],
            ['Do those things interest him?'],
            ['Does she like this idea?'],
            ['Does money interest him?'],
            ['Does this woman work in another place?'],
            ['Does she want to solve this problem?'],
            ['Do his words motivate her?'],
            ['Does your father come home late?'],
            ['Does this hotel look very good?'],
            ['Does she like this place?'],
            ['Does it seem really interesting?'],
            ['Does he try to change it?'],
            ['Do they agree with it?'],
            ['Who do you know?'],
            ['When do you go to work?'],
            ['Where do they spend time together?'],
            ['Why do you agree with him?'],
            ['What kind of computer games do they play?'],
            ['What time do you go to bed?'],
            ['What do you want to say?'],
            ['What do you want to do?'],
            ['How often do you go to the gym?'],
            ['?'],
            ['?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                1,
                1,
                3,
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
