<?php

use yii\db\Migration;

class m200630_163245_create_tense_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tense}}', [
            'id'          => $this
                ->primaryKey(),
            'title'       => $this
                ->string()
                ->unique()
                ->notNull()
                ->comment('Название времени'),
            'translation' => $this
                ->string()
                ->unique()
                ->notNull()
                ->comment('Перевод названия времени'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tense}}');
    }
}
