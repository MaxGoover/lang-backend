<?php

namespace app\controllers\book;

use app\controllers\ApiController;
use app\models\response\DTO;
use app\repositories\BookPartReadRepository;
use Yii;

class BookPartController extends ApiController
{
    private BookPartReadRepository $_bookPartReadRepository;
    private DTO $_dto;

    public function __construct(
        $id,
        $module,
        BookPartReadRepository $bookPartReadRepository,
        DTO $dto,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_bookPartReadRepository = $bookPartReadRepository;
        $this->_dto = $dto;
    }

    public function actionIndex() {
        $bookPartId = Yii::$app->request->post('bookPartId');
        return $this->_dto->success(
            $this->_bookPartReadRepository->getByBookPartId($bookPartId)
        );
    }
}