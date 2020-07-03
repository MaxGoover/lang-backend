<?php

use yii\db\Migration;

class m200630_124233_create_training_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%training}}', [
            'id'          => $this
                ->primaryKey(),
            'level_id'    => $this
                ->integer()
                ->notNull()
                ->comment('ID уровня'),
            'title'       => $this
                ->string()
                ->unique()
                ->notNull()
                ->comment('Название тренировки'),
            'translation' => $this
                ->string()
                ->unique()
                ->notNull()
                ->comment('Перевод названия тренировки'),
            'alias'       => $this
                ->string()
                ->unique()
                ->notNull()
                ->comment('Псевдоним названия тренировки'),
            'avatar'      => $this
                ->string()
                ->notNull()
                ->comment('Аватарка тренировки'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%training}}');
    }
}
