<?php

namespace app\controllers\grammar;

use app\controllers\ApiController;
use app\models\response\DTO;
use app\repositories\grammar\ExerciseReadRepository;

class ExerciseController extends ApiController
{
    private ExerciseReadRepository $_exerciseReadRepository;
    private DTO $_dto;

    public function __construct(
        $id,
        $module,
        ExerciseReadRepository $exerciseReadRepository,
        DTO $dto,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_exerciseReadRepository = $exerciseReadRepository;
        $this->_dto = $dto;
    }

    public function actionIndex() {
        $alias = \Yii::$app->request->post('alias');
        $session = \Yii::$app->session;
        $session->open();
        $session['post'] = \Yii::$app->request->post();
        $session['alias'] = $alias;
        $session->close();
        return $this->_dto->success(
            $this->_exerciseReadRepository->getByAlias($alias)
        );
    }
}