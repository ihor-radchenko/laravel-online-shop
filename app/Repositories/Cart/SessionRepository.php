<?php

namespace AutoKit\Repositories\Cart;

use AutoKit\Components\Cart\CartItem;
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
    }

    private function putInCart($cart)
    {
        return session()->put('cart', $cart);
    }

    private function cart()
    {
        return session('cart');
    }
}