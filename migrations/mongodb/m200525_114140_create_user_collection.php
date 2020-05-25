<?php

class m200525_114140_create_user_collection extends \yii\mongodb\Migration
{
    private $_collection = 'user';

    public function up()
    {
        $this->createCollection($this->_collection);
    }

    public function down()
    {
        $this->dropCollection($this->_collection);
    }
}
