<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173807_fill_passive_present_simple_question_exercise_collection extends Migration
{
    private array $_sentences = [
        'Что показывается по телевизору?',
        'Почему прячется это сокровище?',
        'Где это делается (производится)?',
        'Почему его критикуют так часто?',
        'Кем делаются эти ошибки?',
        'Кем была сделана работа?',
        'Кого грабят?',
        'Как измеряется их прогресс?',
        'Кем проверяется эта информация?',
        'Почему такие вещи игнорируются?',
        'Кем смотрится этот канал?',
        'Куда это кладут?',
        'Это делается в Италии?',
        'Где выращивается эта еда?',
        'Что производится в этой стране?',
        'Над кем смеются?',
        '?',
        '?',
        '?',
    ];

    public function up()
    {
        $translations = [
            ['What`s shown on TV?'],
            ['Why is this treasure hidden?'],
            ['Where is it made?'],
            ['Why is he criticized so often?'],
            ['Who are these mistakes made by?'],
            ['Who was the work done by?'],
            ['Who is robbed?'],
            ['How is their progress measured?'],
            ['Who`s this information checked?'],
            ['Why are such things ignored?'],
            ['Who is this channel watched by?'],
            ['Where is it put?'],
            ['Is it made in Italy?'],
            ['Where is this food grown?'],
            ['What`s produced in this country?'],
            ['Who is laughed at?'],
            ['?'],
            ['?'],
            ['?'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
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
