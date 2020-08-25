<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173805_fill_passive_present_simple_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'Верят, что эта вещь реально помогает.',
        'Такие предложения переводятся более медленно.',
        'Эти правила очень ясно объясняются здесь.',
        'Нам часто говорят делать это.',
        'Эти деньги воруют.',
        'Говорят, это самый эффективный способ изучения английского языка.',
        'Предполагается, что это произойдет.',
        'Его часто хвалят.',
        'Ему помогают.',
        'Работа делается им.',
        'Тебе платят эти деньги.',
        'Это делается в Китае.',
        'Ожидается, что я избавлюсь от всех этих ошибок полностью.',
        'Никого не наказывают.',
        'Такие вопросы часто задаются.',
        'Их прогресс измеряется время от времени.',
        'С ним обращаются так несправедливо.',
        'Ожидается, что эта вещь произойдет.',
        'Этот канал смотрится столькими многими людьми.',
        'Мне часто говорят учиться усерднее.',
        'Слишком мало делается нами.',
        'Предполагается, что это произойдет.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['It`s believed that this thing really helps.'],
            ['Such sentences are translated more slowly.'],
            ['These rules are explained very clearly here.'],
            ['We`re often told to do it.'],
            ['This money is stolen.'],
            ['It`s said it`s the most effective way of learning English.'],
            ['It`s supposed to happen.'],
            ['He`s often praised.'],
            ['He`s helped.'],
            ['The work is done by him.'],
            ['You`re paid this money.'],
            ['It`s made in China.'],
            ['I`m expected to get rid of all these mistakes completely.'],
            ['No one is punished.'],
            ['Such questions are often asked.'],
            ['Their progress is measured from time to time.'],
            ['He`s treated so unfairly.'],
            ['This thing is expected to happen.'],
            ['This channel is watched by so many people.'],
            ['I`m often told to study harder.'],
            ['Too little is done by us.'],
            ['It`s supposed to happen.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
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
