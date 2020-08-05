<?php

namespace app\controllers\shop;

use app\controllers\ApiController;
use shop\forms\Shop\AddToCartForm;
use app\repositories\shop\GoodsReadRepository;
use app\services\shop\CartService;
use Yii;

class CartController extends ApiController
{
    private CartService $_cartService;
    private GoodsReadRepository $_goodsReadRepository;

    public function __construct(
        $id,
        $module,
        CartService $cartService,
        GoodsReadRepository $goodsReadRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_cartService = $cartService;
        $this->_goodsReadRepository = $goodsReadRepository;
    }

    public function actionAdd()
    {

        $goods = $this->_goodsReadRepository->getById();

        if (!$product->modifications) {
            try {
                $this->_service->add($product->id, null, 1);
                Yii::$app->session->setFlash('success', 'Success!');
                return $this->redirect(Yii::$app->request->referrer);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $this->layout = 'blank';

        $form = new AddToCartForm($product);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->add($product->id, $form->modification, $form->quantity);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('add', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    public function actionIndex()
    {
        $cart = $this->_cartService->getCart();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionRemove($id)
    {
        try {
            $this->_service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }
}