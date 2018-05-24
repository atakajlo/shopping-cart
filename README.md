# Shopping cart

Framework independent cart extension. Use in project whatever you want!

[![Build Status](https://travis-ci.org/atakajlo/shopping-cart.svg?branch=master)](https://travis-ci.org/atakajlo/shopping-cart)
[![Latest Stable Version](https://poser.pugx.org/atakajlo/shopping-cart/v/stable)](https://packagist.org/packages/atakajlo/shopping-cart)
[![Total Downloads](https://poser.pugx.org/atakajlo/shopping-cart/downloads)](https://packagist.org/packages/atakajlo/shopping-cart)
[![Latest Unstable Version](https://poser.pugx.org/atakajlo/shopping-cart/v/unstable)](https://packagist.org/packages/atakajlo/shopping-cart)
[![License](https://poser.pugx.org/atakajlo/shopping-cart/license)](https://packagist.org/packages/atakajlo/shopping-cart)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require atakajlo/shopping-cart
```

or add

```
"atakajlo/shopping-cart": "^1.1"
```

to the `require` section of your `composer.json`. 

## Usage

1. Configure cart extension

```php
use atakajlo\cart\cost\calculator\SimpleCalculator;
use atakajlo\cart\Cart;
use atakajlo\cart\item\CartItem;
use atakajlo\cart\storage\SessionStorage;

$cart = new Cart(
    new SessionStorage(),
    new SimpleCalculator()
);
```

2. Add items

```php
$cartItem = new CartItem(1, 100, 1);
$cart->add($cartItem);
```

3. Update item quantity

```php
$cart->changeQuantityById($cartItem->getId(), 5);
```

4. Get all items

```php
$items = $cart->getItems();
```

5. Get cart total cost

```php
$totalCost = $cart->getCost()->getTotal();
```

## Tests

```
$ ./vendor/bin/phpunit
```

## License

This project is released under the terms of the MIT [license](LICENSE).

Copyright (c) 2018, Dmytry Fedorenko