<?php

namespace app\models\book;

use yii\mongodb\ActiveQuery;

/**
 * This is the ActiveQuery class for [[book]].
 *
 * @see Book
 */
class BookQuery extends ActiveQuery
{
    public function byId($id)
    {
        return $this->andWhere(['_id' => $id]);
    }

    ##################################################

    /**
     * {@inheritdoc}
     * @return Book[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Book|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
