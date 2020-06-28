<?php

namespace app\controllers\video;

use app\controllers\ApiController;
use app\models\response\DTO;
use yii\web\UploadedFile;
use FFMpeg\FFMpeg;

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
        $session->close();

        return $this->_dto->success(
            $files
        );
    }
}