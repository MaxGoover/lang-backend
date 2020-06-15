<?php

namespace app\controllers\auth;

use app\controllers\ApiController;
use app\forms\auth\LoginForm;
use app\models\response\DTO;
use app\services\auth\AuthService;

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
        $user = $this->_authService->auth($this->_loginForm);
        $userTokenDTO = $user->refreshToken();
        $this->_authService->login($user, $this->_loginForm->rememberMe);
        return $this->_dto->success([
            'user'  => $user->getPublicData(),
            'token' => $userTokenDTO->getPublicTokenData(),
        ]);
    }

    public function actionLogout()
    {
        $this->_authService->logout();
        return $this->_dto->success(true);
    }
}
