<?php

namespace atakajlo\cart;

use atakajlo\cart\cost\calculator\CalculatorInterface;
use atakajlo\cart\cost\Cost;
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
        if ($currentItem = $this->getItemById($item->getId())) {
            $quantity = $currentItem->getQuantity() + $item->getQuantity();
            $currentItem->setQuantity($quantity);
            $currentItem->setPrice($item->getPrice());
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
        if (array_key_exists($item->getId(), $this->items)) {
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

        if ($item = $this->getItemById($id)) {
            $item->setQuantity($quantity);
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
     * @param $id
     * @return CartItemInterface|null
     */
    public function getItemById($id): ?CartItemInterface
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @return Cost
     */
    public function getCost(): Cost
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