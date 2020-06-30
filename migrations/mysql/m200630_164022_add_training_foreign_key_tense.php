<?php

use yii\db\Migration;

class m200630_164022_add_training_foreign_key_tense extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-training-tense_id',
            'training',
            'tense_id',
            'tense',
            'id',
            'CASCADE',
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-training-tense_id',
            'training',
        );
    }
}
