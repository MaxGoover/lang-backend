<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173922_fill_passive_present_continuous_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        'За ними наблюдают сейчас.',
        'Пассивный залог изучается нами сейчас.',
        '.',
        '.',
        '.',
    ];

    public function up()
    {
        $translations = [
            ['They`re being watched now.'],
            ['Passive Voice is being studied by us.'],
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
