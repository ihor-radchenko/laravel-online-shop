<?php

namespace AutoKit\Repositories\Cart;

use AutoKit\Components\Cart\CartItem;
use Illuminate\Support\Collection;

interface RepositoryContract
{
    public function get(int $key);

    public function set(int $key, CartItem $value);

    public function all(): Collection;

    public function exists(int $key): bool;

    public function unset(int $key);

    public function clear();
}