<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 17.02.2018
 * Time: 19:01
 */

namespace AutoKit\Components\Cart;

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

    public static function make(Product $product, int $quantity)
    {
        return new self($product, $quantity);
    }
}