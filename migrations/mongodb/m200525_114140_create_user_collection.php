<?php

use yii\mongodb\Migration;

/**
 * Class m200525_114140_create_user_collection
 */
class m200525_114140_create_user_collection extends Migration
{
    /**
     * @var string
     */
    private string $_collection = 'user';

    /**
     * @return bool|void
     */
    public function up()
    {
        $this->createCollection($this->_collection);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropCollection($this->_collection);
    }
}
