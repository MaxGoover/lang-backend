<?php

use yii\mongodb\Migration;

class m200617_193902_create_book_parts_collection extends Migration
{
    private string $_collection = 'book_parts';

    public function up()
    {
        $this->createCollection($this->_collection);
    }

    public function down()
    {
        $this->dropCollection($this->_collection);
    }
}
