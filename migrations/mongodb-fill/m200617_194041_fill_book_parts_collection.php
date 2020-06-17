<?php

use app\models\book\bookParts\BookParts;
use MongoDB\BSON\ObjectId;
use yii\mongodb\Migration;

class m200617_194041_fill_book_parts_collection extends Migration
{
    private string $_collection = 'book_parts';

    public function up()
    {
        $this->batchInsert(
            $this->_collection,
            [
                [
                    '_id'        => new ObjectId(),
                    'bookPartId' => 'Wf783hfew',
                    'bookTitle'  => 'Harry Potter and the Philosopher\'s stone - 3',
                    'partTitle'  => 'Kapitel 1',
                    'youtubeId'  => 'aiwu5w26x26d',
                    'content'    => [
                        [
                            'sentences' => [
                                [
                                    'origText'  => 'Origin text part 1',
                                    'transText' => 'Оригинальный текст, часть 1'
                                ],
                                [
                                    'origText'  => 'Origin text part 2',
                                    'transText' => 'Оригинальный текст, часть 2'
                                ],
                                [
                                    'origText'  => 'Origin text part 3',
                                    'transText' => 'Оригинальный текст, часть 3'
                                ],
                            ]
                        ],
                        [
                            'sentences' => [
                                [
                                    'origText'  => 'Origin text part 4',
                                    'transText' => 'Оригинальный текст, часть 4'
                                ],
                                [
                                    'origText'  => 'Origin text part 5',
                                    'transText' => 'Оригинальный текст, часть 5'
                                ],
                                [
                                    'origText'  => 'Origin text part 6',
                                    'transText' => 'Оригинальный текст, часть 6'
                                ],
                                [
                                    'origText'  => 'Origin text part 7',
                                    'transText' => 'Оригинальный текст, часть 7'
                                ],
                            ]
                        ],
                    ],
                    'words'      => [
                        [
                            'origWord'  => 'Hello1',
                            'transWord' => 'Привет1'
                        ],
                        [
                            'origWord'  => 'Hello2',
                            'transWord' => 'Привет2'
                        ],
                        [
                            'origWord'  => 'Hello3',
                            'transWord' => 'Привет3'
                        ],
                        [
                            'origWord'  => 'Hello4',
                            'transWord' => 'Привет4'
                        ],
                        [
                            'origWord'  => 'Hello5',
                            'transWord' => 'Привет5'
                        ],
                        [
                            'origWord'  => 'Hello6',
                            'transWord' => 'Привет6'
                        ],
                    ]
                ]
            ]
        );
    }

    public function down()
    {
        BookParts::deleteAll();
    }
}
