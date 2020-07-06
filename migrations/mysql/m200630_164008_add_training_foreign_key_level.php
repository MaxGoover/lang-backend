<?php

use yii\db\Migration;

class m200630_164008_add_training_foreign_key_level extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-training-level_id',
            'training',
            'level_id',
            'level',
            'id',
            'CASCADE',
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-training-level_id',
            'training',
        );
    }
}
