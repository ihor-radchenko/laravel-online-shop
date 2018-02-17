<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 17.02.2018
 * Time: 16:20
 */

namespace AutoKit\Repositories\Cart;

use Illuminate\Support\Collection;

interface RepositoryContract
{
    public function get($key);

    public function set($key, $value);

    public function all(): Collection;

    public function exists($key): bool;

    public function unset($key);

    public function clear();
}