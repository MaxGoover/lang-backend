<?php
namespace app\controllers\auth;

use app\forms\auth\SignupForm;
use app\models\response\DTO;
use app\services\auth\SignUpService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignUpController extends Controller
{
    public $layout = 'cabinet';

    private $_service;

    public function __construct(
        $id,
        $module,
        SignupService $service,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_service = $service;
    }

    /**
     * @param $token
     * @return mixed
     */
//    public function actionConfirm($token)
//    {
//        try {
//            $this->_service->confirm($token);
//            Yii::$app->session->setFlash('success', 'Your email is confirmed.');
//            return $this->redirect(['auth/auth/login']);
//        } catch (\DomainException $e) {
//            Yii::$app->errorHandler->logException($e);
//            Yii::$app->session->setFlash('error', $e->getMessage());
//        }
//        return $this->goHome();
//    }

    public function actionSignUp(): DTO
    {
        $request = Yii::$app->request;

        $form = new SignupForm();
        if ($form->load($request->post())) return DTO::badRequestError();
        if ($form->validate()) return DTO::validationError();
        try {
            $user = $this->_service->signup($form, $request);

        } catch (\DomainException $e) {
            // somecode
        }



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

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
}
