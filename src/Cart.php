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
     * @var bool
     */
    private $autoSave;

    /**
     * Cart constructor.
     * @param StorageInterface $storage
     * @param CalculatorInterface $calculator
     * @param bool $autoSave
     */
    public function __construct(StorageInterface $storage, CalculatorInterface $calculator, bool $autoSave = true)
    {
        $this->storage = $storage;
        $this->calculator = $calculator;
        $this->autoSave = $autoSave;
        $this->loadItems();
    }

    /**
     * @param CartItemInterface $item
     * @return void
     */
    public function add(CartItemInterface $item): void
    {
        if (isset($this->items[$item->getId()])) {
            $quantity = $this->items[$item->getId()]->getQuantity() + $item->getQuantity();
            $this->items[$item->getId()]->setQuantity($quantity);
            $this->items[$item->getId()]->setPrice($item->getPrice());
        } else {
            $this->items[$item->getId()] = $item;
        }

        if ($this->autoSave)
            $this->saveItems();
    }

    /**
     * @param CartItemInterface $item
     * @param int $quantity
     */
    public function updateQuantity(CartItemInterface $item, int $quantity): void
    {
        if (isset($this->items[$item->getId()])) {
            $this->updateQuantityById($item->getId(), $quantity);
        } else {
            $item->setQuantity($quantity);
            $this->add($item);
        }
    }

    /**
     * @param $id
     * @param int $quantity
     */
    public function updateQuantityById($id, int $quantity)
    {
        if ($quantity == 0) {
            $this->removeById($id);
        }

        if (isset($this->items[$id])) {
            $this->items[$id]->setQuantity($quantity);
        }

        if ($this->autoSave)
            $this->saveItems();
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

        if ($this->autoSave)
            $this->saveItems();
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
        $this->items = [];
        $this->storage->clear();
    }
}