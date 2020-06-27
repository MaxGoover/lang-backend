<?php

use yii\db\Migration;

class m200623_083424_create_level_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%level}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%level}}');
    }
}
