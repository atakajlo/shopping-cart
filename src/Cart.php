<?php

namespace atakajlo\cart;

use atakajlo\cart\calculator\CalculatorInterface;
use atakajlo\cart\item\CartItemInterface;
use atakajlo\cart\storage\StorageInterface;

class Cart
{
    /**
     * @var CartItemInterface[]
     */
    private $items = [];

    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var CalculatorInterface
     */
    private $calculator;

    /**
     * Cart constructor.
     * @param StorageInterface $storage
     * @param CalculatorInterface $calculator
     */
    public function __construct(StorageInterface $storage, CalculatorInterface $calculator)
    {
        $this->storage = $storage;
        $this->calculator = $calculator;
        $this->loadItems();
    }

    /**
     * @param CartItemInterface $item
     * @param int $quantity
     * @return void
     */
    public function add(CartItemInterface $item, $quantity = 1): void
    {
        if (isset($this->items[$item->getId()])) {
            $quantity += $item->getQuantity();
            $this->items[$item->getId()]->setQuantity($quantity);
        } else {
            $this->items[$item->getId()] = $item;
        }
    }

    /**
     * @param CartItemInterface $item
     * @return void
     */
    public function remove(CartItemInterface $item): void
    {
        $this->removeById($item->getId());
    }

    /**
     * @param string|int $id
     * @return void
     */
    public function removeById($id): void
    {
        unset($this->items[$id]);
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->calculator->getCost($this->items);
    }

    /**
     * @return CartItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return void
     */
    public function loadItems(): void
    {
        $this->items = $this->storage->load();
    }

    /**
     * @return void
     */
    public function saveItems(): void
    {
        $this->storage->save($this->items);
    }

    /**
     * @return void
     */
    public function clearItems(): void
    {
        $this->storage->clear();
    }
}