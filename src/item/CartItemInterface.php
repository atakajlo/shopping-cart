<?php

namespace atakajlo\cart\item;

interface CartItemInterface
{
    /**
     * @return string|int
     */
    public function getId();

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @return float
     */
    public function getCost(): float;
}