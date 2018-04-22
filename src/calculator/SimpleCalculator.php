<?php

namespace atakajlo\cart\calculator;

use atakajlo\cart\item\CartItemInterface;

class SimpleCalculator implements CalculatorInterface
{
    /**
     * @param CartItemInterface[] $items
     * @return float
     */
    public function getCost($items): float
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }
}