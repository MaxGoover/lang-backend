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
                ->tinyInteger()
                ->unsigned()
                ->notNull()
                ->comment('ID уровня'),
            'tense_id'    => $this
                ->tinyInteger()
                ->unsigned()
                ->notNull()
                ->comment('ID времени'),
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
                ->unique()
                ->notNull()
                ->comment('Аватарка тренировки'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%training}}');
    }
}
