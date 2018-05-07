<?php

namespace atakajlo\cart\cost\calculator;

use atakajlo\cart\cost\Cost;
use atakajlo\cart\item\CartItemInterface;

class SimpleCalculator implements CalculatorInterface
{
    /**
     * @param CartItemInterface[] $items
     * @return Cost
     */
    public function getCost($items): Cost
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return new Cost($cost);
    }
}