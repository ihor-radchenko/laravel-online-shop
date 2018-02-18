<?php

namespace AutoKit\Repositories\Cart;

use AutoKit\Components\Cart\CartItem;
use Illuminate\Support\Collection;

class SessionRepository implements RepositoryContract
{
    public function __construct()
    {
        if (! session()->has('cart')) {
            $this->putInSession(collect());
        }
    }

    public function get(int $key)
    {
        return $this->cart()->get($key);
    }

    public function set(int $key, CartItem $value)
    {
        $this->putInSession($this->cart()->put($key, $value));
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
        $this->putInSession($this->cart()->forget($key));
    }

    public function clear()
    {
        $this->putInSession(collect());
    }

    private function putInSession($cart)
    {
        return session()->put('cart', $cart);
    }

    private function cart()
    {
        return session('cart');
    }
}