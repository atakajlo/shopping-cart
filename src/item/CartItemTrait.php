<?php

namespace atakajlo\cart\item;

trait CartItemTrait
{
    /**
     * @var int
     */
    private $quantity;
    /**
     * @var float
     */
    private $price;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->getPrice() * $this->getQuantity();
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}