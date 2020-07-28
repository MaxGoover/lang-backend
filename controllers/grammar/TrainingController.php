<?php

namespace app\controllers\grammar;

use app\controllers\ApiController;
use app\models\response\DTO;
use app\repositories\grammar\ExerciseReadRepository;
use app\repositories\grammar\TrainingReadRepository;
use Yii;

class TrainingController extends ApiController
{
    private DTO $_dto;
    private ExerciseReadRepository $_exerciseReadRepository;
    private TrainingReadRepository $_trainingReadRepository;

    public function __construct(
        $id,
        $module,
        DTO $dto,
        ExerciseReadRepository $exerciseReadRepository,
        TrainingReadRepository $trainingReadRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_dto = $dto;
        $this->_exerciseReadRepository = $exerciseReadRepository;
        $this->_trainingReadRepository = $trainingReadRepository;
    }

    public function actionIndex() {
        $post = Yii::$app->request->post();
        return $this->_dto->success([
            'exercises' => $this->_exerciseReadRepository->getByConditions($post['conditions']),
            'training' => $this->_trainingReadRepository->getByAlias($post['alias']),
        ]

        );
    }
}