<?php

namespace AutoKit\Components\Cart;

use AutoKit\Product;

class CartItemCreator
{
    public function factory(Product $product, int $quantity)
    {
        return new CartItem($product, $quantity);
    }
}