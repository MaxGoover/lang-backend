<?php

namespace app\other\cart\cost;

final class Cost
{
    private float $_price;

    public function __construct(float $price)
    {
        $this->_price = $price;
    }

    public function getOrigin(): float
    {
        return $this->_price;
    }
}