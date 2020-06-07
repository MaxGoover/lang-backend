<?php

namespace app\controllers\auth;

use app\forms\auth\LoginForm;
use app\identity\Identity;
use app\models\response\DTO;
use app\services\auth\AuthService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AuthController extends Controller
{
    private $_dto;
    private $_service;

    public function __construct(
        $id,
        $module,
        DTO $dto,
        AuthService $service,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_dto = $dto;
        $this->_service = $service;
    }

    /**
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }




    public function actionSignIn() {

    }

    public function actionSignOut() {

    }

    public function actionSignUp(): DTO
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->_service->auth($form);
                Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);

        //////////////////////////////////////////

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if ($form->load(Yii::$app->request->post())) return DTO::badRequestError();
        if ($form->validate()) return DTO::validationError();
        try {
//            $user = $this->_service->auth($form);
            Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
            if ($user->save()) return DTO::internalServerError();
            return DTO::success([
                'user'  => $model->getUser()->publicData,
                'token' => $model->getTokenDto()->getPublicTokenData(),
            ]);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return DTO::unauthorizedError();
        }












        if ($model->attributes = $request->post()) {
            if ($model->login()) {
                try {
                    $user = $model->getUser(); // логинимся
                    if ($user->save()) {
                        $responseDto->setData([
                            'user'  => $model->getUser()->publicData,
                            'token' => $model->getTokenDto()->getPublicTokenData(),
                        ]);
                    } else {
                        $responseDto->setInternalServerError();
                    }
                } catch (Exception $e) {
                    $responseDto->setInternalServerError();
                }
            } else {
                $responseDto->setValidationError($model->errors);
            }
        } else {
            $responseDto->setBadRequestError();
        }

        return $responseDto->getResponseData();
    }

    ##################################################

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
