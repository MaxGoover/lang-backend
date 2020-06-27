<?php

use yii\db\Migration;

class m200623_083447_create_level_tense_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%level_tense}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%level_tense}}');
    }
}
