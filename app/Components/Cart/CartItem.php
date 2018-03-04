<?php

namespace AutoKit\Components\Cart;

use AutoKit\Components\Money\Money;
use AutoKit\Product;

class CartItem
{
    /**
     * @var Product
     */
    public $product;

    /**
     * @var int
     */
    public $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getAmount(): Money
    {
        return $this->product->price->mul($this->quantity);
    }

    public function allInCart(): bool
    {
        return $this->quantity === $this->product->quantity;
    }
}