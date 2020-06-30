<?php

use yii\db\Migration;

class m200630_182010_fill_tense_table extends Migration
{
    private string $_tableName = 'tense';

    public function safeUp()
    {
        $this->batchInsert(
            $this->_tableName,
            [
                'id',
                'title',
                'translation',
            ],
            [
                [
                    1,
                    'Present Simple',
                    'Настоящее простое',
                ],
                [
                    2,
                    'Past Simple',
                    'Простое прошедшее',
                ],
                [
                    3,
                    'Future Simple',
                    'Простое будущее',
                ],
                [
                    4,
                    'Present Continuous',
                    'Настоящее продолженное',
                ],
                [
                    5,
                    'Past Continuous',
                    'Прошедшее продолженное',
                ],
                [
                    6,
                    'Future Continuous',
                    'Будущее продолженное',
                ],
                [
                    7,
                    'Present Perfect',
                    'Настоящее совершенное',
                ],
                [
                    8,
                    'Past Perfect',
                    'Прошедшее совершенное',
                ],
                [
                    9,
                    'Future Perfect',
                    'Будущее совершенное',
                ],
                [
                    10,
                    'Present Perfect Continuous',
                    'Настоящее совершенное продолженное',
                ],
                [
                    11,
                    'Past Perfect Continuous',
                    'Прошедшее совершенное продолженное',
                ],
                [
                    12,
                    'Future Perfect Continuous',
                    'Будущее совершенное продолженное',
                ],
            ]
        );
    }

    public function safeDown()
    {
        if (Yii::$app->db->schema->getTableSchema($this->_tableName)) {
            $this->delete($this->_tableName, ['id' => range(1, 12)]);
        }
    }
}
