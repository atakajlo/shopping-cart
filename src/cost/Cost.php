<?php

namespace atakajlo\cart\cost;

final class Cost
{
    /**
     * @var float
     */
    private $value;
    /**
     * @var array
     */
    private $discounts;

    /**
     * Cost constructor.
     * @param float $value
     * @param array $discounts
     */
    public function __construct(float $value, array $discounts = [])
    {
        $this->value = $value;
        $this->discounts = $discounts;
    }

    /**
     * @param Discount $discount
     * @return Cost
     */
    public function withDiscount(Discount $discount): self
    {
        return new static($this->value, array_merge($this->discounts, [$discount]));
    }

    /**
     * @return float
     */
    public function getOrigin(): float
    {
        return $this->value;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return array_sum(array_map(function(Discount $discount) {
            return $discount->getValue();
        }, $this->discounts));
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->value - $this->getDiscount();
    }

    /**
     * @return array
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }
}