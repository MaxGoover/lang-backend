<?php

namespace app\other\cart\cost;

final class Cost
{
    private float $_cost;

    public function __construct(float $cost)
    {
        $this->_cost = $cost;
    }

    public function getCost(): float
    {
        return $this->_cost;
    }
}