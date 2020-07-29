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
                'title',
                'translation',
                'alias',
                'avatar',
            ],
            [
                [
                    1,
                    1,
                    'Present Simple',
                    'Настоящее простое',
                    'present-simple',
                    '1-Facebook',
                ],
                [
                    2,
                    1,
                    'Past Simple',
                    'Прошедшее простое',
                    'past-simple',
                    '2-Ig',
                ],
                [
                    3,
                    1,
                    'Future Simple',
                    'Будущее простое',
                    'future-simple',
                    '3-Skype',
                ],
                [
                    4,
                    1,
                    'Numerals',
                    'Числительные',
                    'numerals',
                    '4-Android',
                ],
                [
                    5,
                    3,
                    'Test',
                    'Тест',
                    'test-test',
                    '5-Youtube',
                ],
                [
                    6,
                    3,
                    'Test2',
                    'Тест2',
                    'test-test2',
                    '6-Dribbble',
                ],
                [
                    7,
                    3,
                    'Test3',
                    'Тест3',
                    'test-test3',
                    '7-Line',
                ],
                [
                    8,
                    3,
                    'Test4',
                    'Тест4',
                    'test-test4',
                    '8-Youtube',
                ],
                [
                    9,
                    3,
                    'Test5',
                    'Тест5',
                    'test-test5',
                    '9-Messager',
                ],
            ]
        );
    }

    public function safeDown()
    {
        if (Yii::$app->db->schema->getTableSchema($this->_tableName)) {
            $this->delete($this->_tableName, ['id' => range(1, 9)]);
        }
    }
}
