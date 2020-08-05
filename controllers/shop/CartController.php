<?php

namespace app\controllers\shop;

use app\controllers\ApiController;
use app\forms\shop\AddToCartForm;
use app\models\response\DTO;
use app\repositories\shop\GoodsReadRepository;
use app\services\shop\CartService;
use Yii;

class CartController extends ApiController
{
    private CartService $_cartService;
    private DTO $_dto;
    private GoodsReadRepository $_goodsReadRepository;

    public function __construct(
        $id,
        $module,
        CartService $cartService,
        DTO $dto,
        GoodsReadRepository $goodsReadRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_cartService = $cartService;
        $this->_dto = $dto;
        $this->_goodsReadRepository = $goodsReadRepository;
    }

    public function actionAdd()
    {
        $goods = $this->_goodsReadRepository->getById();
        try {
            $this->_cartService->add($goods->id);
            // todo сделать высплывашку - "Товар добавлен в корзину"
            // todo вернуть DTO success
            return true;
        } catch(\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            // todo сделать высплывашку - "Ошибка добавления товара в корзину"
        }

//        $form = new AddToCartForm($goods);
//
//        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
//            try {
//                $this->_cartService->add($goods, $form->quantity);
//                // todo вернуть DTO success
//                return true;
//            } catch (\DomainException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error', $e->getMessage());
//            }
//        }
    }

    public function actionIndex()
    {
        return $this->_dto->success([
            $this->_cartService->getCart()
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionRemove($id)
    {
        try {
            $this->_cartService->remove($id);
        } catch(\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }
}