<?php
namespace app\controllers\auth;

use app\forms\auth\SignupForm;
use app\identity\Identity;
use app\models\response\DTO;
use app\services\auth\SignUpService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignUpController extends Controller
{
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

    public function actionIndex(): DTO
    {
        $request = Yii::$app->request;

        $form = new SignupForm();
        if ($form->load($request->post())) return DTO::badRequestError();
        if ($form->validate()) return DTO::validationError();
        try {
            $user = $this->_service->signup($form, $request);
            Yii::$app->user->login(new Identity($user), $form->rememberMe ? 2592000 : 0);
            return DTO::success([
                'user'  => $user->getPublicData(),
                'token' => $user->tokens,
            ]);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return DTO::unauthorizedError();
        }
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
