<?php

namespace app\controllers\api\closed;

use app\controllers\api\ApiPublicController;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

/**
 * Class ApiPrivateController
 * @package app\controllers\api\closed
 */
class ApiPrivateController extends ApiPublicController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        if (Yii::$app->request->isOptions) { // ToDo: исправить уязвимость
            return parent::behaviors();
        } else {
            return ArrayHelper::merge([
                'authenticator' => [
                    'class' => HttpBearerAuth::class,
                ],
            ], parent::behaviors());
        }
    }
}
