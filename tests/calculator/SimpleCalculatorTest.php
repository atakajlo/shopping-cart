<?php

namespace tests\calculator;

use atakajlo\cart\calculator\SimpleCalculator;
use atakajlo\cart\item\CartItem;
use PHPUnit\Framework\TestCase;

class SimpleCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new SimpleCalculator();
        $cost = $calculator->getCost([
            new CartItem(1, 100, 1),
            new CartItem(2, 200, 2)
        ]);
        $this->assertEquals(500, $cost);
    }
}