[![Build Status](https://api.travis-ci.org/pashamesh/cart.svg?branch=master)](https://travis-ci.org/pashamesh/cart)
[![Coverage Status](https://coveralls.io/repos/github/pashamesh/cart/badge.svg?branch=master)](https://coveralls.io/github/pashamesh/cart?branch=master)
[![codecov.io](https://codecov.io/github/pashamesh/cart/coverage.svg?branch=master)](https://codecov.io/github/pashamesh/cart?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pashamesh/cart/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pashamesh/cart/?branch=master)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/93b100f30e9d49a2a827ad35b559b292)](https://www.codacy.com/manual/pashamesh/cart?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=pashamesh/cart&amp;utm_campaign=Badge_Grade)
[![Latest Stable Version](https://poser.pugx.org/pashamesh/cart/v/stable)](https://packagist.org/packages/pashamesh/cart)
[![Total Downloads](https://poser.pugx.org/pashamesh/cart/downloads)](https://packagist.org/packages/pashamesh/cart)
[![Latest Unstable Version](https://poser.pugx.org/pashamesh/cart/v/unstable)](https://packagist.org/packages/pashamesh/cart)
[![PHP 7 ready](http://php7ready.timesplinter.ch/pashamesh/cart/badge.svg)](https://travis-ci.org/pashamesh/cart)
[![License](https://poser.pugx.org/pashamesh/cart/license)](https://packagist.org/packages/pashamesh/cart)

# Simple Shopping Cart for PHP

* [Website](https://github.com/pashamesh/cart)
* [License](https://github.com/pashamesh/cart/master/LICENSE)

This simple shopping cart composer package makes it easy to implement a shopping basket into your application and
store the cart data using one of the numerous data stores provided. You can also inject your own data store if you
would like your cart data to be stored elsewhere.

## Installation
You can install the package via composer:
```bash
composer require pashamesh/cart
```

## Usage
Below is a basic usage guide for this package.

### Instantiating the cart
Before you begin, you will need to know which storage and identifier method you are going to use. The identifier is
how you store which cart is for that user. So if you store your cart in the database, then you need a cookie (or some
other way of storing an identifier) so we can link the user to a stored cart.

In this example we're going to use the cookie identifier and session for storage.

```php
use voku\Cart\Cart;
use voku\Cart\Storage\Session;
use voku\Cart\Identifier\Cookie;

$cart = new Cart(new Session, new Cookie);
```

### Inserting items into the cart
Inserting an item into the cart is easy. The required keys are id, name, price and quantity, although you can pass
over any custom data that you like.
```php
$cart->insert(
    array(
        'id'       => 'foo',
        'name'     => 'bar',
        'price'    => 100,
        'quantity' => 1
    )
);
```

### Setting the tax rate for an item
Another key you can pass to your insert method is 'tax'. This is a percentage which you would like to be added onto
the price of the item.

In the below example we will use 20% for the tax rate.

```php
$cart->insert(
    array(
        'id'       => 'foo',
        'name'     => 'bar',
        'price'    => 100,
        'quantity' => 1,
        'tax'      => 20
    )
);
```

### Updating items in the cart
You can update items in your cart by updating any property on a cart item. For example, if you were within a
cart loop then you can update a specific item using the below example.
```php
foreach ($cart->contents() as $item)
{
    $item->name = 'Foo';
    $item->quantity = 1;
}
```

### Removing cart items
You can remove any items in your cart by using the `$cart->remove()` method on any cart item.
```php
foreach ($cart->contents() as $item)
{
    $cart->remove($item->getIdentifier());
    // or even
    $cart->remove($item);
}
```

### Destroying/emptying the cart
You can completely empty/destroy the cart by using the `destroy()` method.
```php
$cart->destroy();
```

### Retrieve the cart contents
You can loop the cart contents by using the following method
```php
$cart->contents();
```

You can also return the cart items as an array by passing true as the first argument
```php
$cart->contents(true);
```

### Retrieving the total items in the cart
```php
$cart->totalItems();
```

By default this method will return all items in the cart as well as their quantities. You can pass `true`
as the first argument to get all unique items.
```php
$cart->totalItems(true);
```

### Retrieving the cart total
```php
$cart->total();
```

By default the `total()` method will return the total value of the cart as a `float`, this will include
any item taxes. If you want to retrieve the cart total without tax then you can do so by passing false to the
`total()` method
```php
$cart->total(false);
```

### Check if the cart has an item
```php
$cart->has($itemIdentifier);
```

### Retreive an item object by identifier
```php
$cart->item($itemIdentifier);
```

## Cart items
There are several features of the cart items that may also help when integrating your cart.

### Retrieving the total value of an item
You can retrieve the total value of a specific cart item (including quantities) using the following method.
```php
$item->total();
```

By default, this method will return the total value of the item plus tax. So if you had a product which costs 100,
with a quantity of 2 and a tax rate of 20% then the total returned by this method would be 240.

You can also get the total minus tax by passing false to the `total()` method.
```php
$item->total(false);
```

This would return 200.

### Check if an item has options
You can check if a cart item has options by using the `hasOptions()` method.

```php
if ($item->hasOptions())
{
  // We have options
}
```

### Remove an item from the cart
```php
$item->remove();
```

### Output the item data as an array
```php
$item->toArray();
```
