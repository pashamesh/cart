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
 * @package moltin/cart
 * @author Chris Harvey <chris@molt.in>
 * @copyright 2013 Moltin Ltd.
 * @version dev
 * @link http://github.com/moltin/cart
 *
 */

namespace voku\Cart;

/**
 * Interface StorageInterface
 */
interface StorageInterface
{
    /**
     * Add or update an item in the cart
     *
     * @param Item $item
     *
     * @return mixed
     */
    public function insertUpdate(Item $item);

    /**
     * Retrieve the cart data
     *
     * @param bool $asArray
     *
     * @return mixed
     */
    public function &data($asArray = false);

    /**
     * Check if the item exists in the cart
     *
     * @param mixed $identifier
     *
     * @return mixed
     */
    public function has($identifier);

    /**
     * Get a single cart item by id
     *
     * @param mixed $identifier The item id
     *
     * @return Item The item class
     */
    public function item($identifier);

    /**
     * Returns the first occurrence of an item with a given id
     *
     * @param  string $id The item id
     *
     * @return Item       Item object
     */
    public function find($id);

    /**
     * Remove an item from the cart
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function remove($id);

    /**
     * Destroy the cart
     *
     * @return void
     */
    public function destroy();

    /**
     * Set the cart identifier
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier);

    /**
     * Return the current cart identifier
     *
     * @return void
     */
    public function getIdentifier();
}
