<?php

use app\models\book\bookPart\BookPart;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200702_094723_fill_exercise_collection extends Migration
{
    private string $_collection = 'exercise';

    public function up()
    {
        $this->batchInsert(
            $this->_collection,
            [
                [
                    '_id'               => new ObjectId(),
                    'title'             => 'Harry Potter and the Philosopher\'s stone - 1',
                    'description'       => 'Первая глава первой книги о Гарри Поттере',
                    'imageUrl'          => '/img/kitty.png',
                    'rating'            => 4,
                    'ratingCount'       => 100,
                    'level'             => ['B2', 'C1'],
                    'youtubePlaylistId' => 'er7638es2JD781j',
                    'parts'             => [
                        [
                            'id' => 'Wf783hfew',
                            'title' => 'Kapitel 1',
                            'youtubeId' => 'cn473ief'
                        ],
                        [
                            'id' => 'T8443hfew',
                            'title' => 'Kapitel 2',
                            'youtubeId' => 'Dw6e3ief'
                        ],
                        [
                            'id' => 'L32j3hfew',
                            'title' => 'Kapitel 3',
                            'youtubeId' => '7so13ief'
                        ],
                        [
                            'id' => 'so5q3hfew',
                            'title' => 'Kapitel 4',
                            'youtubeId' => 'mc7s3ief'
                        ],
                    ],
                ],
                [
                    '_id'               => new ObjectId(),
                    'title'             => 'Harry Potter and the Philosopher\'s stone - 2',
                    'description'       => 'Вторая глава первой книги о Гарри Поттере',
                    'imageUrl'          => '/img/kitty.png',
                    'rating'            => 3.5,
                    'ratingCount'       => 55,
                    'level'             => ['B1', 'B2'],
                    'youtubePlaylistId' => 'd628shes2JD781j',
                    'parts'             => [
                        [
                            'id' => 'Wf783hfew',
                            'title' => 'Kapitel 1',
                            'youtubeId' => 'cn473ief'
                        ],
                        [
                            'id' => 'T8443hfew',
                            'title' => 'Kapitel 2',
                            'youtubeId' => 'Dw6e3ief'
                        ],
                        [
                            'id' => 'L32j3hfew',
                            'title' => 'Kapitel 3',
                            'youtubeId' => '7so13ief'
                        ],
                        [
                            'id' => 'so5q3hfew',
                            'title' => 'Kapitel 4',
                            'youtubeId' => 'mc7s3ief'
                        ],
                    ],
                ],
                [
                    '_id'               => new ObjectId(),
                    'title'             => 'Harry Potter and the Philosopher\'s stone - 3',
                    'description'       => 'Третья глава первой книги о Гарри Поттере',
                    'imageUrl'          => '/img/kitty.png',
                    'rating'            => 2,
                    'ratingCount'       => 80,
                    'level'             => ['A2'],
                    'youtubePlaylistId' => 'lt6rr38es2JD781j',
                    'parts'             => [
                        [
                            'id' => 'Wf783hfew',
                            'title' => 'Kapitel 1',
                            'youtubeId' => 'cn473ief'
                        ],
                        [
                            'id' => 'T8443hfew',
                            'title' => 'Kapitel 2',
                            'youtubeId' => 'Dw6e3ief'
                        ],
                        [
                            'id' => 'L32j3hfew',
                            'title' => 'Kapitel 3',
                            'youtubeId' => '7so13ief'
                        ],
                        [
                            'id' => 'so5q3hfew',
                            'title' => 'Kapitel 4',
                            'youtubeId' => 'mc7s3ief'
                        ],
                    ],
                ],
            ]
        );
    }

    public function down()
    {
        Book::deleteAll();
    }
}
