<?php

namespace tests\cost\calculator;

use atakajlo\cart\cost\calculator\CalculatorInterface;
use atakajlo\cart\cost\Cost;
use atakajlo\cart\item\CartItemInterface;

class TestCalculator implements CalculatorInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param CartItemInterface[] $items
     * @return Cost
     */
    public function getCost($items): Cost
    {
        return new Cost($this->value);
    }
}