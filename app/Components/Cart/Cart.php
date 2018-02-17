<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 17.02.2018
 * Time: 18:07
 */

namespace AutoKit\Components\Cart;

use AutoKit\Product;
use AutoKit\Repositories\Cart\RepositoryContract;
use Illuminate\Support\Collection;

class Cart
{
    /**
     * @var RepositoryContract
     */
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function add(Product $product, int $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($product);
            return;
        }
        if ($this->has($product)) {
            $quantity += $this->get($product)->quantity;
        }
        $this->update($product, $quantity);
    }

    private function update(Product $product, int $quantity)
    {
        $this->repository->set($product->id, CartItem::make($product, $quantity));
    }

    public function get(Product $product): CartItem
    {
        return $this->repository->get($product->id);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function remove(Product $product)
    {
        $this->repository->unset($product->id);
    }

    public function clear()
    {
        $this->repository->clear();
    }

    public function has(Product $product): bool
    {
        return $this->repository->exists($product->id);
    }
}