<?php

namespace atakajlo\cart\calculator;

use atakajlo\cart\item\CartItemInterface;

interface CalculatorInterface
{
    /**
     * @param CartItemInterface[] $items
     * @return float
     */
    public function getCost($items): float;
}