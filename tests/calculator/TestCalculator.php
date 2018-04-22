<?php

namespace tests\calculator;

use atakajlo\cart\calculator\CalculatorInterface;
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
     * @return float
     */
    public function getCost($items): float
    {
        return $this->value;
    }
}