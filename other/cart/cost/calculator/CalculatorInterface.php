<?php

namespace app\other\cart\cost\calculator;

use app\other\cart\CartItem;
use app\other\cart\cost\Cost;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function getCost(array $items): Cost;
} 