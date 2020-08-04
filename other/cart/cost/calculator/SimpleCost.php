<?php

namespace app\other\cart\cost\calculator;

use app\other\cart\CartItem;
use app\other\cart\cost\Cost;

class SimpleCost implements CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function getCost(array $items): Cost
    {
        $cost = 0;
        foreach($items as $item) {
            $cost += $item->getCost();
        }

        return new Cost($cost);
    }
}