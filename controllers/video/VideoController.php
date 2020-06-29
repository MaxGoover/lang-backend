<?php

namespace app\controllers\video;

use app\controllers\ApiController;
use app\forms\video\VideoFileForm;
use app\models\response\DTO;
use yii\web\UploadedFile;

class VideoController extends ApiController
{
    private DTO $_dto;

    public function __construct(
        $id,
        $module,
        DTO $dto,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_dto = $dto;
    }

    public function actionConvert() {
        $files = UploadedFile::getInstancesByName('files');
        $session = \Yii::$app->session;
        $session->open();
        $session['check'] = $files;
        $session['files'] = $_FILES;

        $model = new VideoFileForm();
        $model->files = $files;

        try {
            $model->validate();
            return $this->_dto->success($model->saveFilesAndGetData());
        } catch (\Exception $e) {
            return $this->_dto->validationError($model->errors);
        }
    }
}