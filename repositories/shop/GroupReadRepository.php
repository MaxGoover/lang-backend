<?php

namespace app\repositories\shop;

use yii\db\Query as MysqlQuery;

class GroupReadRepository
{
    public function getAll(): array
    {
        $query = new MysqlQuery();
        $select = [
            'id' => 'gr.id',
            'title' => 'gr.title',
            'goods' => "JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id', gd.id,
                    'title', gd.title,
                    'description', gd.description,
                    'price', gd.price,
                    'quantity', gd.quantity
                )
            )"
        ];

        $data = $query
            ->select($select)
            ->from('shop_goods AS gd')
            ->leftJoin('shop_group AS gr', 'gr.id = gd.group_id')
            ->orderBy('gr.sort')
            ->groupBy(['id', 'title'])
            ->all();

        return $this->_normalizedData($data);
    }

    private function _normalizedData (array $data): array
    {
        $result = [];
        foreach ($data as $i => $item) {
            foreach ($item as $key => $value) {
                if ($key === 'goods') {
                    $result[$i][$key] = json_decode($value);
                } else {
                    $result[$i][$key] = $value;
                }
            }
        }
        return $result;
    }
}