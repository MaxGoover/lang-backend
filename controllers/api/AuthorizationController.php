<?php

namespace app\controllers\api;

use app\models\authorization\login\LoginFormCreator;
use app\models\response\Response;
use app\models\response\ResponseDTO;
use Yii;
use yii\base\Exception;

/**
 * Class AuthorizationController
 * @package app\controllers\api
 */
class AuthorizationController extends ApiPublicController
{
    /**
     * Login action.
     *
     * @return ResponseDTO
     */
    public function actionLogin(): ResponseDTO
    {
        $responseDto = new Response();
        $request = Yii::$app->request;

        $model = LoginFormCreator::getLoginFormByType($request->post('type', LoginFormCreator::TYPE_SCORECARD)); // сюда мы будем передавать тип авторизации

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

    /**
     * Sign up action.
     *
     * @return ResponseDTO
     */
//    public function actionSignUp(): ResponseDTO
//    {
//        $responseDto = new Response();
//
//        $model = new SignUpForm();
//
//        if ($model->load(Yii::$app->request->post())) {
//            try {
//                if ($model->validate()) {
//                    if ($userModel = $model->signup()) {
//
//                        // Creates user info by type if its not exists
//                        $userInfoFactory = new UserInfoFactory();
//                        if ($userInfoClass = $userInfoFactory->getUserInfoClassNameByType($userModel->type)) {
//
//                            if (!($userInfoModel = $userInfoClass::find()->byUserId($userModel->id)->one())) {
//                                $userInfoModel = $userInfoClass::createByUserModel($userModel);
//                            }
//
//                            // Create or refresh exists token
//                            $tokenDto = $userInfoModel->refreshToken();
//
//                            if ($userInfoModel->save()) {
//                                $responseDto->setData([
//                                    'user'  => $userModel->publicData,
//                                    'token' => $tokenDto->getPublicTokenData(),
//                                ]);
//                            } else {
//                                $responseDto->setInternalServerError();
//                            }
//                        } else {
//                            $responseDto->setInternalServerError();
//                        }
//
//                    } else {
//                        $responseDto->setInternalServerError();
//                    }
//                } else {
//                    $responseDto->setValidationError($model->errors);
//                }
//            } catch (Exception $e) {
//                $responseDto->setInternalServerError($e);
//            }
//        } else {
//            $responseDto->setBadRequestError();
//        }
//
//        return $responseDto->getResponseData();
//    }

    /**
     * Update token.
     *
     * @return ResponseDTO
     */
//    public function actionUpdateToken(): ResponseDTO
//    {
//        $responseDto = new Response();
//
//        if ($refreshToken = Yii::$app->request->post('refreshToken')) {
//            if ($userInfoModel = UserInfo::findIdentityByRefreshToken($refreshToken)) {
//                try {
//
//                    // Create or refresh exists token
//                    $tokenDto = $userInfoModel->refreshToken();
//
//                    if ($userInfoModel->save()) {
//                        $responseDto->setData([
//                            'token' => $tokenDto->getPublicTokenData(),
//                        ]);
//                    } else {
//                        $responseDto->setInternalServerError();
//                    }
//
//                } catch (Exception $e) {
//                    $responseDto->setInternalServerError();
//                }
//            } else {
//                $responseDto->setNotFoundError();
//            }
//        } else {
//            $responseDto->setBadRequestError();
//        }
//
//        return $responseDto->getResponseData();
//    }
}
