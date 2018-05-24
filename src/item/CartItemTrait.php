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
}