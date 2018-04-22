<?php

namespace atakajlo\cart\calculator;

use atakajlo\cart\item\CartItemInterface;
use DateTime;

class BirthdayCalculator implements CalculatorInterface
{
    /**
     * @var CalculatorInterface
     */
    private $next;
    /**
     * @var DateTime
     */
    private $birthday;
    /**
     * @var DateTime
     */
    private $now;
    /**
     * @var string
     */
    private $format;
    /**
     * @var int|float
     */
    private $percent;

    public function __construct(CalculatorInterface $next, $percent, string $birthday, string $now, $format = 'Y-m-d')
    {
        $this->next = $next;
        $this->format = $format;
        $this->birthday = DateTime::createFromFormat($this->format, $birthday);
        $this->now = DateTime::createFromFormat($this->format, $now);
        $this->percent = $percent;
    }

    /**
     * @param CartItemInterface[] $items
     * @return float
     */
    public function getCost($items): float
    {
        $cost = $this->next->getCost($items);
        if ($this->birthday == $this->now) {
            return (1 - $this->percent / 100) * $cost;
        }
        return $cost;
    }
}