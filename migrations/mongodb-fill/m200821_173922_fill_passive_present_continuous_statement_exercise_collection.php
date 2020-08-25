<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173922_fill_passive_present_continuous_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'За ними наблюдают сейчас.',
        'Пассивный залог изучается нами сейчас.',
        'Ситуация контроллируется сейчас.',
        'Этот монастырь восстанавливают сейчас.',
        'Их знания тестируются сейчас.',
        'Здание разрушают сейчас.',
        'Их прогресс измеряется сейчас.',
        'Им помогают сейчас.',
        '.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['They`re being watched now.'],
            ['Passive Voice is being studied by us.'],
            ['The situation is being controlled now.'],
            ['This monastery is being rebuilt now.'],
            ['Their knowledge are being tested now.'],
            ['The building is being destroyed now.'],
            ['Their progress is being measured now.'],
            ['They`re being helped now.'],
            ['.'],
            ['.'],
            ['.'],
            ['.'],
        ];

        foreach ($this->_sentences as $key => $sentence) {
            $model = Exercise::create(
                new ObjectId(),
                0,
                4,
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
