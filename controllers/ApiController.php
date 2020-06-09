<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
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

    protected function load (Model $model) {
        if (!$model->load(Yii::$app->request->post())) {
            throw new BadRequestHttpException('Model load error');
        }
        return $model;
    }

    protected function validate (Model $model) {
        if (!$model->validate()) {
            throw new BadRequestHttpException('Model validation error');
        }
        return $model;
    }

    protected function save (Model $model) {
        if (!$model->save()) {
            throw new ServerErrorHttpException('Model save error');
        }
        return $model;
    }
}