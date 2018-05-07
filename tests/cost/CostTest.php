<?php

namespace tests\cost;

use atakajlo\cart\cost\Cost;
use atakajlo\cart\cost\Discount;
use PHPUnit\Framework\TestCase;

class CostTest extends TestCase
{
    public function testDiscount()
    {
        $discount = new Discount(5, 'Test Discount');
        $cost = new Cost(100, [$discount]);

        $this->assertNotEmpty($cost->getDiscounts());
        $this->assertEquals(5, $cost->getDiscount());
        $this->assertEquals(100, $cost->getOrigin());
        $this->assertEquals(95, $cost->getTotal());
    }
}