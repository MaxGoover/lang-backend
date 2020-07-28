<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200726_223156_fill_459_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Это нужно тебе.',
        'Он заказывает еду в другом месте.',
        'Это происходит время от времени.',
        'Я думаю, ты знаешь это лучше.',
        'Это нужно мне.',
        'Его девушка все знает.',
        'Я пытаюсь сделать это.',
        'Он согласен с тобой.',
        'Я стараюсь находить больше времени на это.',
        'У него так много интересных идей.',
        'Мне нужно сделать это как можно скорее.',
        'Он читает все документы.',
        'Нам нужно заплатить за это.',
        'Он всегда говорит это.',
        'Она не говорит мне эти вещи.',
        'Она согласна с тобой.',
        'Я вижу, вы очень хорошо говорите по-английски.',
        'Мне нужно идти домой.',
        'У него так много проблем.',
        'Это мне нравится.',
        'У его партнера есть интересное предложение.',
        'Я хотел бы сделать это.',
        'Я хочу отдохнуть.',
        'Ему нужно запомнить это.',
        'Я хотел бы знать больше английских слов.',
        'Его отец обычно приходит домой позже.',
        'Ему нужно учиться усерднее.',
        'Его английский кажется действительно хорошим.',
        'Я стараюсь тренировать свою память.',
        'У нее есть дом.',
        'У нее красивый дом.',
        'Мой друг хочет быстро выучить английский.',
        'Нам нужно решить эту проблему.',
        'Мне очень нужен твой совет.',
        'Ей нравится это.',
        'Ему очень нравится этот канал.',
        'Мне очень нужны эти уроки.',
        'Мы часто ходим в бар.',
        'Он обычно приходит домой очень поздно.',
        'Его отцу нужно меньше работать.',
        'Я хочу делать это более регулярно.',
        'Он работает очень усердно.',
        'Я со своим другом часто обсуждаем это.',
        'Эта компания такая богатая. Мы все видим ее успех.',
        'Ему это нужно.',
        'У него новая машина.',
        'Она обычно приходит домой рано.',
        'Мне нужно тренировать свою память.',
        'Это нам нравится.',
        'Мне бы хотелось чашечку чая сейчас.',
        'Это ему нравится.',
        'Я хочу тренировать свою память.',
        'Я хочу сделать это.',
        'Ему нужно позвонить ей.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['You need it.'],
            ['He orders food in another place.'],
            ['It happens from time to time.'],
            ['I think you know it better.'],
            ['I need it.'],
            ['His girlfriend knows everything.'],
            ['I try to do it.'],
            ['He agrees with you.'],
            ['I try to find more time on it.'],
            ['He has so many interesting ideas.'],
            ['I need to do it as soon as possible.'],
            ['He reads all the documents.'],
            ['We need to pay for it.'],
            ['He always says it.'],
            ['She agrees with you.'],
            ['I see you speak English very well.'],
            ['I need to go home.'],
            ['He has so many problems.'],
            ['I like it.'],
            ['His partner has an interesting offer.'],
            ['I`d like to do it.'],
            ['I want to have a rest.'],
            ['He needs to remember it.'],
            ['I`d like to know more English words.'],
            ['His father usually comes home later.'],
            ['He needs to study harder.'],
            ['His English seems really good.'],
            ['I try to train my memory.'],
            ['She has a house.'],
            ['She has a beautiful house.'],
            ['My friend wants to learn English fast.'],
            ['We need to solve this problem.'],
            ['I really need your advice.'],
            ['She likes it.'],
            ['He really likes this channel.'],
            ['I really need these lessons.'],
            ['We often go to the park.'],
            ['He usually comes home very late.'],
            ['His father needs to work less.'],
            ['I want to do it more regularly.'],
            ['He works very hard.'],
            ['My friend and I often discuss it.'],
            ['This company so rich. We all see its success.'],
            ['He needs it.'],
            ['He has a new car.'],
            ['She usually come home early.'],
            ['I need to train my memory.'],
            ['We like it.'],
            ['I`d like a cup of tea now.'],
            ['He likes it.'],
            ['I want to train my memory.'],
            ['I want to do it.'],
            ['He needs to call her.'],
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
