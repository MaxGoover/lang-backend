<?php

namespace app\controllers\grammar;

use app\controllers\ApiController;
use app\models\response\DTO;
use app\repositories\book\BookReadRepository;

class ExerciseController extends ApiController
{
    private BookReadRepository $_bookReadRepository;
    private DTO $_dto;

    public function __construct(
        $id,
        $module,
        BookReadRepository $bookReadRepository,
        DTO $dto,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_bookReadRepository = $bookReadRepository;
        $this->_dto = $dto;
    }

    public function actionIndex() {
        return $this->_dto->success(
            $this->_bookReadRepository->getAll()
        );
    }
}