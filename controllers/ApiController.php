<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class ApiController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::$app->language = Yii::$app->request->headers->get('Accept-Language');
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            'corsFilter'        => [
                'class' => Cors::class,
                'cors'  => Yii::$app->params['apiCorsOptions'],
            ],
            'contentNegotiator' => [
                'class'   => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ], parent::behaviors());
    }

    protected function loadModel (Model $model) {
        if (!$model->load(Yii::$app->request->post())) {
            throw new BadRequestHttpException('Model load error');
        }
    }

    protected function validateModel (Model $model) {
        if (!$model->validate()) {
            throw new BadRequestHttpException('Model validation error');
        }
    }
}