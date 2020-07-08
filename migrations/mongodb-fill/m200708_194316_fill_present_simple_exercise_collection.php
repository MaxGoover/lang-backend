<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_194316_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Она чувствует себя счастливой.',
        'Он также это помнит.',
        'Он живет в этом доме.',
        'Она тоже там работает.',
        'Он это знает.',
        'Она действительно это помнит.',
        'Она тоже так думает.',
        'Он тоже это знает.',
        'Она живет в том месте.',
        'Она любит тебя.',
    ];

    public function up()
    {
        $translations = [
            ['She feels happy.'],
            ['He also remembers it.'],
            ['He lives in this house.'],
            ['She also works there.'],
            ['He knows it.'],
            ['She really remembers it.'],
            ['She also thinks so.'],
            ['He also knows it.'],
            ['She lives in that place.'],
            ['She loves you.'],
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
