<?php

namespace tests\cost\calculator;

use atakajlo\cart\cost\calculator\BirthdayCalculator;
use PHPUnit\Framework\TestCase;

class BirthdayCalculatorTest extends TestCase
{
    public function testActive()
    {
        $calculator = new BirthdayCalculator(new TestCalculator(100), 5, '2018-05-05', '2018-05-05');
        $this->assertEquals(95, $calculator->getCost([])->getTotal());
    }

    public function testNonActive()
    {
        $calculator = new BirthdayCalculator(new TestCalculator(100), 5, '2018-05-05', '2018-05-01');
        $this->assertEquals(100, $calculator->getCost([])->getTotal());
    }
}