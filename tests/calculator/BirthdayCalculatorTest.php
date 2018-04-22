<?php

namespace tests\calculator;

use atakajlo\cart\calculator\BirthdayCalculator;
use PHPUnit\Framework\TestCase;

class BirthdayCalculatorTest extends TestCase
{
    public function testActive()
    {
        $calculator = new BirthdayCalculator(new TestCalculator(100), 5, '2018-05-05', '2018-05-05');
        $this->assertEquals(95, $calculator->getCost([]));
    }

    public function testNonActive()
    {
        $calculator = new BirthdayCalculator(new TestCalculator(100), 5, '2018-05-05', '2018-05-01');
        $this->assertEquals(100, $calculator->getCost([]));
    }
}