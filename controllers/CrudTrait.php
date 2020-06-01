<?php

    namespace app\controllers;

    use app\models\response\Response;
    use app\models\response\ResponseDTO;
    use Yii;

    /**
     * Trait CrudTrait
     * @package app\controllers
     */
    trait CrudTrait
    {
        /**
         * Creates new model.
         *
         * @return ResponseDTO
         */
        public function actionCreate(): ResponseDTO
        {
            $response = new Response();

            $model = new $this->modelName();

            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save(false)) {
                        $response->setData($model);
                    } else {
                        $response->setInternalServerError();
                    }
                } else {
                    $response->setValidationError($model->errors);
                }
            } else {
                $response->setBadRequestError();
            }

            return $response->getResponseData();
        }

        /**
         * Reads model.
         *
         * @return ResponseDTO
         */
        public function actionRead(): ResponseDTO
        {
            $response = new Response();

            if ($id = Yii::$app->request->post('id')) {
                $response->setData($this->modelName::findOne($id));
            } else {
                $response->setBadRequestError();
            }

            return $response->getResponseData();
        }

        /**
         * Updates model.
         *
         * @return ResponseDTO
         */
        public function actionUpdate(): ResponseDTO
        {
            $response = new Response();

            $request = Yii::$app->request;

            if ($model = $this->modelName::findOne($request->post('id'))) {
                if ($model->load($request->post())) {
                    if ($model->validate()) {
                        if ($model->save(false)) {
                            $response->setData($model);
                        } else {
                            $response->setInternalServerError();
                        }
                    } else {
                        $response->setValidationError($model->errors);
                    }
                } else {
                    $response->setBadRequestError();
                }
            } else {
                $response->setNotFoundError();
            }

            return $response->getResponseData();
        }

        /**
         * Deletes model.
         *
         * @return ResponseDTO
         */
        public function actionDelete(): ResponseDTO
        {
            $response = new Response();

            if ($model = $this->modelName::findOne(Yii::$app->request->post('id'))) {
                try {
                    if ($model->delete()) {
                        $response->setData(true);
                    } else {
                        $response->setInternalServerError();
                    }
                } catch (\Exception $e) {
                    $response->setInternalServerError();
                }
            } else {
                $response->setNotFoundError();
            }

            return $response->getResponseData();
        }
    }