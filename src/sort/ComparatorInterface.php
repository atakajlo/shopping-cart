<?php

namespace atakajlo\cart\sort;

use atakajlo\cart\item\CartItemInterface;

interface ComparatorInterface
{
    /**
     * @param CartItemInterface $a
     * @param CartItemInterface $b
     * @return int
     */
    public function compare(CartItemInterface $a, CartItemInterface $b): int;
}