<?php

namespace atakajlo\cart\sort;

use atakajlo\cart\item\CartItemInterface;

class IdComparator implements ComparatorInterface
{
    /**
     * @param CartItemInterface $a
     * @param CartItemInterface $b
     * @return int
     */
    public function compare(CartItemInterface $a, CartItemInterface $b): int
    {
        return $a->getId() <=> $b->getId();
    }
}