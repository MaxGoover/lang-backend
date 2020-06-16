<?php

use yii\mongodb\Migration;

class m200615_153647_create_book_collection extends Migration
{
    private string $_collection = 'book';

    public function up()
    {
        $this->createCollection($this->_collection);
    }

    public function down()
    {
        $this->dropCollection($this->_collection);
    }
}
