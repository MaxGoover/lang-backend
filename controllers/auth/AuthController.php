<?php

namespace app\controllers\auth;

use app\forms\auth\LoginForm;
use app\identity\Identity;
use app\models\response\DTO;
use app\models\user\User;
use app\services\auth\AuthService;
use Yii;
use yii\base\Exception;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response as Resp;
use app\models\response\Response;

class AuthController extends Controller
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
                    'application/json' => Resp::FORMAT_JSON,
                ],
            ],
        ], parent::behaviors());
    }

//    private AuthService $_service;
//
//    public function __construct(
//        $id,
//        $module,
//        AuthService $service,
//        $config = [])
//    {
//        parent::__construct($id, $module, $config);
//        $this->_service = $service;
//    }

    public function actionLogin() {
        $form = new LoginForm();
        $dto = new DTO();
        $session = Yii::$app->session;
        $session->open();
        if (!($form->attributes = Yii::$app->request->post())) return $dto->badRequestError();
        $session['2'] = unserialize(serialize($form));
        if (!$form->validate()) return $dto->validationError();
        $session['3'] = unserialize(serialize($form));
        if (!$user = User::find()->byUsername($form->username)->active()->one()) return $dto->notFoundError();
        $session['4'] = unserialize(serialize($user));
        $userTokenDTO = $user->refreshToken();
        $session['5'] = unserialize(serialize($userTokenDTO));
        if (!$user->save()) return $dto->internalServerError();
        Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
        $session['6'] = unserialize(serialize($dto->success([
            'user'  => $user->publicData,
            'token' => $userTokenDTO->getPublicTokenData(),
        ])));
        $session->close();
        return $dto->success([
            'user'  => $user->publicData,
            'token' => $userTokenDTO->getPublicTokenData(),
        ]);


//        try {
//            $user = $this->_service->auth($form);
//            Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
//            if ($user->save()) return DTO::internalServerError();
//            return DTO::success([
//                'user'  => $model->getUser()->publicData,
//                'token' => $model->getTokenDto()->getPublicTokenData(),
//            ]);
//        } catch (\DomainException $e) {
//            Yii::$app->errorHandler->logException($e);
//            Yii::$app->session->setFlash('error', $e->getMessage());
//            return DTO::unauthorizedError();
//        }


//        $session = Yii::$app->session;
//        $session->open();
//
//        $responseDto = new Response();
//        $request = Yii::$app->request;
//
//        $model = new LoginForm();
//
//        if ($model->attributes = $request->post()) {
//            $session['1'] = unserialize(serialize($model));
//            if ($model->login()) {
//                try {
//                    $session['2'] = unserialize(serialize($model));
//                    $user = $model->getUser(); // логинимся
//                    $session['3'] = unserialize(serialize($user));
//                    if ($user->save()) {
//                        $responseDto->setData([
//                            'user'  => $model->getUser()->publicData,
//                            'token' => $model->getTokenDto()->getPublicTokenData(),
//                        ]);
//                    } else {
//                        $responseDto->setInternalServerError();
//                    }
//                } catch (Exception $e) {
//                    $responseDto->setInternalServerError();
//                }
//            } else {
//                $responseDto->setValidationError($model->errors);
//            }
//        } else {
//            $responseDto->setBadRequestError();
//        }
//        $session['4'] = unserialize(serialize($responseDto));
//        $session->close();
//
//        return $responseDto->getResponseData();

//        $form = new LoginForm();
//        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
//            try {
//                $user = $this->_service->auth($form);
//                Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
//                return $this->goBack();
//            } catch (\DomainException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error', $e->getMessage());
//            }
//        }
    }

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

//        return $this->render('login', [
//            'model' => $form,
//        ]);

        //////////////////////////////////////////

//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }

//        if ($form->load(Yii::$app->request->post())) return DTO::badRequestError();
//        if ($form->validate()) return DTO::validationError();
//        try {
//            $user = $this->_service->auth($form);
//            Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
//            if ($user->save()) return DTO::internalServerError();
//            return DTO::success([
//                'user'  => $model->getUser()->publicData,
//                'token' => $model->getTokenDto()->getPublicTokenData(),
//            ]);
//        } catch (\DomainException $e) {
//            Yii::$app->errorHandler->logException($e);
//            Yii::$app->session->setFlash('error', $e->getMessage());
//            return DTO::unauthorizedError();
//        }
    }
//    /**
//     * @inheritdoc
//     */
//    public function behaviors(): array
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::class,
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }
}
