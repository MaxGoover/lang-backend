<?php

use yii\mongodb\Migration;

class m200702_094400_create_exercise_collection extends Migration
{
    private string $_collection = 'exercise';

    public function up()
    {
        $this->createCollection($this->_collection);
    }

    public function down()
    {
        $this->dropCollection($this->_collection);
    }
}
