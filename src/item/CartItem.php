<?php

namespace atakajlo\cart\item;

class CartItem implements CartItemInterface
{
    use CartItemTrait;

    private $id;
    private $price;

    public function __construct($id, $price, int $quantity)
    {
        $this->id = $id;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * @return string|int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}