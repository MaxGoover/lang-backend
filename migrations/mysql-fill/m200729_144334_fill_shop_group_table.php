<?php

use yii\db\Migration;

class m200729_144334_fill_shop_group_table extends Migration
{
    private string $_tableName = 'shop_group';

    public function safeUp()
    {
        $this->batchInsert(
            $this->_tableName,
            [
                'id',
                'title',
                'sort',
            ],
            [
                [
                    1,
                    'Книги',
                    1,
                ],
                [
                    2,
                    'Еда',
                    2,
                ],
                [
                    5,
                    'Спорт',
                    2,
                ],
                [
                    8,
                    'Сантехника',
                    3,
                ],
                [
                    10,
                    'Запчасти для машин',
                    3,
                ],
                [
                    15,
                    'Сувениры',
                    2,
                ],
            ]
        );
    }

    public function safeDown()
    {
        if (Yii::$app->db->schema->getTableSchema($this->_tableName)) {
            $this->delete($this->_tableName, ['id' => [1, 2, 5, 8, 10, 15]]);
        }
    }
}
