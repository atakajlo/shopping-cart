<?php

namespace atakajlo\cart\cost;

final class Discount
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $value;
    /**
     * @var bool
     */
    private $isActive = true;

    public function __construct(float $value, string $name)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param bool $isActive
     */
    public function setActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }
}