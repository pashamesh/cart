<?php

/**
 * This file is part of Moltin Cart, a PHP package to handle
 * your shopping basket.
 *
 * Copyright (c) 2013 Moltin Ltd.
 * http://github.com/moltin/cart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   moltin/cart
 * @author    Chris Harvey <chris@molt.in>
 * @copyright 2013 Moltin Ltd.
 * @version   dev
 * @link      http://github.com/moltin/cart
 *
 */

namespace voku\Cart\Identifier;

use voku\Cart\IdentifierInterface;

/**
 * Shopping-Identifier via Cookie.
 */
class Cookie implements IdentifierInterface
{
    /**
     * Forget the identifier
     *
     * @return bool|void
     */
    public function forget()
    {
        return setcookie('cart_identifier', null, time() - 3600, '/');
    }

    /**
     * Get the current or new unique identifier
     *
     * @return string The identifier
     */
    public function get()
    {
        if (isset($_COOKIE['cart_identifier']))
        {
            return $_COOKIE['cart_identifier'];
        }

        return $this->regenerate();
    }

    /**
     * Regenerate the identifier
     *
     * @return string The identifier
     */
    public function regenerate()
    {
        $identifier = md5(uniqid(null, true));

        setcookie('cart_identifier', $identifier, 0, '/');

        return $identifier;
    }
}
