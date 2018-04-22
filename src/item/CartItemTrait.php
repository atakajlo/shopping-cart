<?php

namespace atakajlo\cart\item;

trait CartItemTrait
{
    /**
     * @var int
     */
    private $quantity;

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
}