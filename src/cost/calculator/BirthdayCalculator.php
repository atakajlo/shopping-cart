<?php

namespace atakajlo\cart\cost\calculator;

use atakajlo\cart\cost\Cost;
use atakajlo\cart\cost\Discount;
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
     * @return Cost
     */
    public function getCost($items): Cost
    {
        $cost = $this->next->getCost($items);
        if ($this->birthday == $this->now) {
            $discount = new Discount(($this->percent / 100) * $cost->getOrigin(), 'Скидка ко дню рождения');
            return $cost->withDiscount($discount);
        }
        return $cost;
    }
}