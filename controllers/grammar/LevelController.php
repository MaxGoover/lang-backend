<?php

namespace app\controllers\grammar;

use app\controllers\ApiController;
use app\models\response\DTO;
use app\repositories\grammar\LevelReadRepository;

class LevelController extends ApiController
{
    private LevelReadRepository $_levelReadRepository;
    private DTO $_dto;

    public function __construct(
        $id,
        $module,
        LevelReadRepository $levelReadRepository,
        DTO $dto,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_levelReadRepository = $levelReadRepository;
        $this->_dto = $dto;
    }

    public function actionIndex() {
        return $this->_dto->success(
            $this->_levelReadRepository->getAll()
        );
    }
}