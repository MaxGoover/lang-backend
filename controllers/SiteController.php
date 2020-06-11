<?php

namespace app\controllers;

use app\forms\auth\LoginForm;
use app\forms\auth\SignupForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignUpForm();

//        if ($model->load(Yii::$app->request->post())) {
//            if ($user = $model->signUp()) {
//                return $this->goHome();
//            }
//        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    ##################################################

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'captcha' => [
                'class' => yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'error' => [
                'class' => yii\web\ErrorAction::class,
            ],
        ];
    }
}
