<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 17.02.2018
 * Time: 16:26
 */

namespace AutoKit\Repositories\Cart;

use Illuminate\Support\Collection;

class SessionRepository implements RepositoryContract
{
    private $cart;

    public function __construct($cart)
    {
        if (! session()->has($cart)) {
            session()->put($cart, collect());
        }
        $this->cart = session($cart);
    }

    public function get($key)
    {
        return $this->cart->get($key);
    }

    public function set($key, $value)
    {
        $this->cart->put($key, $value);
    }

    public function all(): Collection
    {
        return $this->cart;
    }

    public function exists($key): bool
    {
        return $this->cart->has($key);
    }

    public function unset($key)
    {
        $this->cart->forget($key);
    }

    public function clear()
    {
        $this->cart = collect();
    }
}