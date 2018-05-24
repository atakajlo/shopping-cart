<?php

namespace tests;

use atakajlo\cart\cost\calculator\SimpleCalculator;
use atakajlo\cart\Cart;
use atakajlo\cart\item\CartItem;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @var Cart
     */
    private $cart;

    protected function setUp()
    {
        $this->cart = new Cart(
            new storage\FakeStorage(),
            new SimpleCalculator()
        );
        parent::setUp();
    }

    public function testCreate()
    {
        $this->assertEmpty($this->cart->getItems());
    }

    public function testAddNew()
    {
        $item = new CartItem(1, 100, 5);
        $this->cart->add($item);
        $this->assertEquals(1, $item->getId());
        $this->assertEquals(100, $item->getPrice());
        $this->assertEquals(5, $item->getQuantity());
        $this->assertEquals(500, $item->getCost());
    }

    public function testAddExist()
    {
        $this->cart->add(new CartItem(1, 100, 5));
        $this->cart->add(new CartItem(1, 200, 4));
        /** @var CartItem $cartItem */
        $cartItem = current($this->cart->getItems());
        $this->assertEquals(9, $cartItem->getQuantity());
        $this->assertEquals(900, $cartItem->getCost());
    }

    public function testUpdateExist()
    {
        $item = new CartItem(1, 100, 4);
        $this->cart->add($item);
        $quantity = $item->getQuantity() + 1;
        $this->cart->changeQuantity($item, $quantity);
        /** @var CartItem $cartItem */
        $cartItem = current($this->cart->getItems());
        $this->assertEquals(5, $cartItem->getQuantity());
    }

    public function testUpdateNew()
    {
        $item1 = new CartItem(1, 100, 2);
        $item2 = new CartItem(2, 100, 1);
        $this->cart->add($item1);
        $this->cart->changeQuantity($item2, 2);
        $this->assertCount(2, $this->cart->getItems());
        $this->assertEquals(2, $this->cart->getItemById($item1->getId())->getQuantity());
        $this->assertEquals(2, $this->cart->getItemById($item2->getId())->getQuantity());
    }

    public function testRemoveById()
    {
        $this->cart->add(new CartItem(1, 200, 1));
        $this->cart->add(new CartItem(2, 300, 1));
        $this->cart->add(new CartItem(3, 500, 2));
        $this->cart->removeById(2);
        $this->assertCount(2, $this->cart->getItems());
    }

    public function testGetItemById()
    {
        $this->cart->add(new CartItem(1, 200, 1));
        $this->cart->add(new CartItem(2, 300, 2));
        $item = $this->cart->getItemById(2);
        $this->assertEquals(2, $item->getId());
        $this->assertEquals(300, $item->getPrice());
        $this->assertEquals(2, $item->getQuantity());
    }

    public function testClear()
    {
        $this->cart->add(new CartItem(1, 100, 1));
        $this->cart->clearItems();
        $this->assertEmpty($this->cart->getItems());
    }

    public function testCost()
    {
        $this->cart->add(new CartItem(1, 100, 1));
        $this->cart->add(new CartItem(2, 200, 2));
        $this->assertEquals(500, $this->cart->getCost()->getTotal());
    }
}