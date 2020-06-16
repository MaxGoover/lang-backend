<?php

use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200615_155909_fill_book_collection extends Migration
{
    private $_collection = 'book';

    public function up()
    {
        $this->batchInsert(
            $this->_collection,
            [
                [
                    '_id'               => new ObjectId(),
                    'title'             => 'Harry Potter and the Philosopher\'s stone - 1',
                    'description'       => 'Первая глава первой книги о Гарри Поттере',
                    'imageUrl'          => '',
                    'rating'            => 4,
                    'ratingCount'       => 100,
                    'level'             => ['B2', 'C1'],
                    'youtubePlaylistId' => 'er7638es2JD781j'
                ],
                [
                    '_id'               => new ObjectId(),
                    'title'             => 'Harry Potter and the Philosopher\'s stone - 2',
                    'description'       => 'Вторая глава первой книги о Гарри Поттере',
                    'imageUrl'          => '',
                    'rating'            => 3.5,
                    'ratingCount'       => 55,
                    'level'             => ['B1', 'B2'],
                    'youtubePlaylistId' => 'd628shes2JD781j'
                ],
                [
                    '_id'               => new ObjectId(),
                    'title'             => 'Harry Potter and the Philosopher\'s stone - 3',
                    'description'       => 'Третья глава первой книги о Гарри Поттере',
                    'imageUrl'          => '',
                    'rating'            => 2,
                    'ratingCount'       => 80,
                    'level'             => ['A2'],
                    'youtubePlaylistId' => 'lt6rr38es2JD781j'
                ],
            ]
        );
    }

    public function down()
    {
        RecordLoaderField::deleteAll([
            'in',
            'record_loader_type_id',
            [
                RecordLoaderType::QMT_0376_SN_CHAT_RECORD_LOADER_ID,
                RecordLoaderType::QMT_0376_RAP_CHAT_RECORD_LOADER_ID,
            ]
        ]);
    }
}
