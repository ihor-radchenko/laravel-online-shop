<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 18.02.2018
 * Time: 7:47
 */

namespace AutoKit\Components\Cart;

use AutoKit\Product;

class CartItemCreator
{
    public function factory(Product $product, int $quantity)
    {
        return new CartItem($product, $quantity);
    }
}