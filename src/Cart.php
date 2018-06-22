<?php

namespace atakajlo\cart;

use atakajlo\cart\cost\calculator\CalculatorInterface;
use atakajlo\cart\cost\Cost;
use atakajlo\cart\item\CartItemInterface;
use atakajlo\cart\sort\ComparatorInterface;
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
     * @var ComparatorInterface
     */
    private $comparator;

    /**
     * Cart constructor.
     * @param StorageInterface $storage
     * @param CalculatorInterface $calculator
     * @param ComparatorInterface $comparator
     * @param bool $autoSave
     */
    public function __construct(StorageInterface $storage, CalculatorInterface $calculator, ComparatorInterface $comparator, bool $autoSave = true)
    {
        $this->storage = $storage;
        $this->calculator = $calculator;
        $this->comparator = $comparator;
        $this->autoSave = $autoSave;
        $this->loadItems();
    }

    /**
     * @param CartItemInterface $item
     * @return void
     */
    public function add(CartItemInterface $item): void
    {
        foreach ($this->items as $i => $current) {
            if ($item->getId() == $current->getId()) {
                $quantity = $current->getQuantity() + $item->getQuantity();
                $this->items[$i] = $item->changeQuantity($quantity);

                if ($this->autoSave)
                    $this->saveItems();

                return;
            }
        }

        $this->items[] = $item;

        if ($this->autoSave)
            $this->saveItems();
    }

    /**
     * @param CartItemInterface $item
     * @param int $quantity
     */
    public function changeQuantity(CartItemInterface $item, int $quantity): void
    {
        $this->changeQuantityById($item->getId(), $quantity);
    }

    /**
     * @param $id
     * @param int $quantity
     */
    public function changeQuantityById($id, int $quantity): void
    {
        if ($quantity == 0) {
            $this->removeById($id);
        } else {
            foreach ($this->items as $i => $item) {
                if ($item->getId() == $id) {
                    $this->items[$i] = $item->changeQuantity($quantity);
                }
            }
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
        foreach ($this->items as $i => $item) {
            if ($item->getId() == $id) {
                unset($this->items[$i]);
            }
        }

        if ($this->autoSave)
            $this->saveItems();
    }

    /**
     * @param $id
     * @return CartItemInterface
     */
    public function getItemById($id): CartItemInterface
    {
        foreach ($this->items as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }

        throw new \DomainException('Illegal item ID');
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
        $this->sort();
    }

    /**
     * @return void
     */
    public function saveItems(): void
    {
        $this->storage->save($this->items);
        $this->sort();
    }

    /**
     * @return void
     */
    public function clearItems(): void
    {
        $this->items = [];
        $this->storage->clear();
    }

    /**
     * Sorting cart items by some strategy
     */
    public function sort(): void
    {
        uasort($this->items, [$this->comparator, 'compare']);
    }
}