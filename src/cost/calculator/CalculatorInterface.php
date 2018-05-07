<?php

namespace atakajlo\cart\cost\calculator;

use atakajlo\cart\cost\Cost;
use atakajlo\cart\item\CartItemInterface;

interface CalculatorInterface
{
    /**
     * @param CartItemInterface[] $items
     * @return Cost
     */
    public function getCost($items): Cost;
}