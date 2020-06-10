<?php
namespace app\controllers\auth;

use app\controllers\ApiController;
use app\forms\auth\SignupForm;
use app\models\response\DTO;
use app\services\auth\SignupService;
use Yii;

class SignupController extends ApiController
{
    private DTO $_dto;
    private SignupForm $_signupForm;
    private SignupService $_signupService;

    public function __construct(
        $id,
        $module,
        DTO $dto,
        SignupForm $signupForm,
        SignupService $signupService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_dto = $dto;
        $this->_signupForm = $signupForm;
        $this->_signupService = $signupService;
    }

    public function actionSignup() {
        $this->loadModel($this->_signupForm);
        $this->validateModel($this->_signupForm);
        $user = $this->_signupService->signup($this->_signupForm);
        return $this->_dto->success([
            'user'  => $user->getPublicData(),
            'token' => $user->getPublicTokenData(),
        ]);
    }

    public function actionConfirm($token)
    {
        try {
            $this->_service->confirm($token);
            Yii::$app->session->setFlash('success', 'Your email is confirmed.');
            return $this->redirect(['auth/auth/login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->goHome();
    }


    public function actionRequest()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->signup($form);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    ##################################################

//    public function behaviors(): array
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'only' => ['index'],
//                'rules' => [
//                    [
//                        'actions' => ['index'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                ],
//            ],
//        ];
//    }
}
