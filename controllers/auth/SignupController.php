<?php

namespace app\controllers\auth;

use app\controllers\ApiController;
use app\forms\auth\SignupForm;
use app\models\response\DTO;
use app\services\auth\SignupService;

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
}
