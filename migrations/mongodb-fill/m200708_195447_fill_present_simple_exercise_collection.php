<?php

use app\models\grammar\exercise\Exercise;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200708_195447_fill_present_simple_exercise_collection extends Migration
{
    private array $_sentences = [
        'Она всегда делает это вовремя.',
        'Она ходит в школу.',
        'Он делает это каждый день.',
        'Он скучает по тебе.',
        'Она иногда ходит в кино.',
        'Он иногда играет в компьютерные игры.',
        'У него есть собака.',
        'Она преподает это.',
        'Он пытается найти работу.',
        'Он ходит на работу.',
    ];

    public function up()
    {
        $translations = [
            ['She always does it on time.'],
            ['She goes to school.'],
            ['He does it every day.'],
            ['He misses you.'],
            ['She sometimes goes to the cinema.'],
            ['He sometimes plays computer games.'],
            ['He has a dog.'],
            ['She teaches it.'],
            ['He tries to find a job.'],
            ['He goes to work.'],
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
