<?php

namespace AutoKit\Repositories\Cart;

use AutoKit\Components\Cart\CartItem;
use AutoKit\Components\Money\Money;
use Illuminate\Support\Collection;

class SessionRepository implements RepositoryContract
{
    public function __construct()
    {
        if (! session()->has('cart')) {
            $this->putInCart(collect());
        }
    }

    public function get(int $key)
    {
        return $this->cart()->get($key);
    }

    public function set(int $key, CartItem $value)
    {
        $this->putInCart($this->cart()->put($key, $value));
    }

    public function all(): Collection
    {
        return $this->cart();
    }

    public function exists(int $key): bool
    {
        return $this->cart()->has($key);
    }

    public function unset(int $key)
    {
        $this->putInCart($this->cart()->forget($key));
    }

    public function clear()
    {
        $this->putInCart(collect());
        $this->setShippingPrice(null);
    }

    public function setShippingPrice(?Money $price)
    {
        session(['cart.shipping' => $price]);
    }

    public function getShippingPrice(): ?Money
    {
        return session('cart.shipping');
    }

    private function putInCart($cart)
    {
        return session(['cart.products' => $cart]);
    }

    private function cart()
    {
        return session('cart.products');
    }
}