<?php

namespace app\controllers\auth;

use app\controllers\ApiController;
use app\forms\auth\LoginForm;
use app\identity\Identity;
use app\models\response\DTO;
use app\models\user\User;
use app\services\auth\AuthService;
use Yii;

class AuthController extends ApiController
{
    private AuthService $_authService;
    private DTO $_dto;
    private LoginForm $_loginForm;

    public function __construct(
        $id,
        $module,
        AuthService $authService,
        DTO $dto,
        LoginForm $loginForm,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_authService = $authService;
        $this->_dto = $dto;
        $this->_loginForm = $loginForm;
    }

    public function actionLogin(): DTO
    {
        $this->loadModel($this->_loginForm);
        $this->validateModel($this->_loginForm);
        $this->_authService->auth($this->_loginForm);

        $user = $this->_userRepository->getByUsername($this->_loginForm->username);
        $user->refreshToken();

        $this->loadModel($this->_loginForm);
        $this->validateModel($this->_loginForm);
        $user = $this->_userRepository->getByUsername($this->_loginForm->username);
        if (!$user = User::find()->byUsername($form->username)->active()->one()) return $this->_dto->notFoundError();
        $userTokenDTO = $user->refreshToken();
        if (!$user->save(false)) return $this->_dto->internalServerError();
        Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
//        throw new NotFoundHttpException('Saving error');
        return $this->_dto->success([
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
