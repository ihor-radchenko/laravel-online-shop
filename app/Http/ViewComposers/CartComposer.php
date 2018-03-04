<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 18.02.2018
 * Time: 8:06
 */

namespace AutoKit\Http\ViewComposers;

use AutoKit\Components\Cart\Cart;
use Illuminate\View\View;

class CartComposer
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function compose(View $view)
    {
        $view->with('cart', $this->cart);
    }
}