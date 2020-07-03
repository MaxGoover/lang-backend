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
                    'PS',
                ],
                [
                    2,
                    1,
                    'Past Simple',
                    'Прошедшее простое',
                    'past-simple',
                    'PS',
                ],
                [
                    3,
                    1,
                    'Future Simple',
                    'Будущее простое',
                    'future-simple',
                    'FS',
                ],
                [
                    4,
                    1,
                    'Numerals',
                    'Числительные',
                    'numerals',
                    'N',
                ],
                [
                    5,
                    3,
                    'Test',
                    'Тест',
                    'test-test',
                    'T',
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
