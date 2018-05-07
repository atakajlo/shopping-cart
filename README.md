### Shopping cart

Framework independent cart extension. Use in project whatever you want!

[![Build Status](https://travis-ci.org/atakajlo/shopping-cart.svg?branch=master)](https://travis-ci.org/atakajlo/shopping-cart)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require atakajlo/shopping-cart
```

or add

```
"atakajlo/shopping-cart": "^1.0"
```

to the `require` section of your `composer.json`. 

## Usage

1. Configure cart extension

```php
use atakajlo\cart\calculator\SimpleCalculator;
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
$cart->updateQuantity($cartItem, 5);
```

4. Get all items

```php
$items = $cart->getItems();
```

5. Get cart total cost

```php
$totalCost = $cart->getCost();
```

## Tests

```
$ ./vendor/bin/phpunit
```

## License

This project is released under the terms of the MIT [license](LICENSE).

Copyright (c) 2018, Dmytry Fedorenko