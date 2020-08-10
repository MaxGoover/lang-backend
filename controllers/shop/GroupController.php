<?php

namespace app\controllers\shop;

use app\controllers\ApiController;
use app\models\response\DTO;
use app\repositories\shop\GroupReadRepository;

class GroupController extends ApiController
{
    private DTO $_dto;
    private GroupReadRepository $_groupReadRepository;

    public function __construct(
        $id,
        $module,
        DTO $dto,
        GroupReadRepository $groupReadRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_dto = $dto;
        $this->_groupReadRepository = $groupReadRepository;
    }

    public function actionIndex(): DTO
    {
        return $this->_dto->success(
            $this->_groupReadRepository->getAll()
        );
    }
}