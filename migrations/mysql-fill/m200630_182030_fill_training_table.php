<?php

use yii\db\Migration;

class m200630_182030_fill_training_table extends Migration
{
    private string $_tableName = 'training';

    public function safeUp()
    {
        $this->batchInsert(
            $this->_tableName,
            [
                'id',
                'level_id',
                'tense_id',
                'title',
                'translation',
                'alias',
                'avatar',
            ],
            [
                [
                    1,
                    1,
                    1,
                    'Present Simple - Active Voice',
                    'Настоящее простое - активный залог',
                    'present-simple-active-voice',
                    'PS',
                ],
                [
                    2,
                    1,
                    1,
                    'Past Simple - Active Voice',
                    'Прошедшее простое - активный залог',
                    'past-simple-active-voice',
                    'PS',
                ],
                [
                    3,
                    1,
                    1,
                    'Future Simple - Active Voice',
                    'Будущее простое - активный залог',
                    'future-simple-active-voice',
                    'FS',
                ],
                [
                    4,
                    1,
                    1,
                    'Numerals',
                    'Числительные',
                    'numerals',
                    'N',
                ],
            ]
        );
    }

    public function safeDown()
    {
        if (Yii::$app->db->schema->getTableSchema($this->_tableName)) {
            $this->delete($this->_tableName, ['id' => range(1, 4)]);
        }
    }
}
