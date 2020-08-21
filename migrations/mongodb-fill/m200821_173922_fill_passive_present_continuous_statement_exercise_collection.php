<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200821_173922_fill_passive_present_continuous_statement_exercise_collection extends Migration
{
    private array $_sentences = [
        '',
    ];

    public function up()
    {
        $translations = [
            [''],
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
