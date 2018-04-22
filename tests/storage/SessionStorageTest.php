<?php

namespace tests\storage;

use atakajlo\cart\item\CartItem;
use atakajlo\cart\storage\SessionStorage;
use atakajlo\cart\storage\StorageInterface;
use PHPUnit\Framework\TestCase;

class SessionStorageTest extends TestCase
{
    /**
     * @var StorageInterface
     */
    private $storage;

    protected function setUp()
    {
        $this->storage = new SessionStorage();
        parent::setUp();
    }


    public function testCreate()
    {
        $this->assertEmpty($this->storage->load());
    }

    public function testStore()
    {
        $this->storage->save([
            new CartItem(1, 100, 1),
            new CartItem(2, 200, 2)
        ]);

        /** @var CartItem $cartItem */
        $cartItem = current($this->storage->load());

        $this->assertCount(2, $this->storage->load());
        $this->assertEquals(1, $cartItem->getId());
        $this->assertEquals(100, $cartItem->getPrice());
        $this->assertEquals(1, $cartItem->getQuantity());
    }
}