<?php

namespace AutoKit\Components\Cart;

use AutoKit\Exceptions\QuantityOverstated;
use AutoKit\Product;
use AutoKit\Repositories\Cart\RepositoryContract;
use Illuminate\Support\Collection;

class Cart
{
    /**
     * @var RepositoryContract
     */
    private $repository;

    /**
     * @var CartItemCreator
     */
    private $creator;

    public function __construct(RepositoryContract $repository, CartItemCreator $creator)
    {
        $this->repository = $repository;
        $this->creator = $creator;
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @throws QuantityOverstated
     */
    public function add(Product $product, int $quantity)
    {
        if ($this->has($product)) {
            $quantity += $this->get($product)->quantity;
        }
        if ($quantity <= 0) {
            $this->remove($product);
            return;
        }
        if (! $product->hasStock($quantity)) {
            throw new QuantityOverstated;
        }
        $this->update($product, $quantity);
    }

    private function update(Product $product, int $quantity)
    {
        $this->repository->set($product->id, $this->creator->factory($product, $quantity));
    }

    public function get(Product $product): ?CartItem
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

    public function totalQuantity(): int
    {
        return $this->all()->sum('quantity');
    }

    public function count(): int
    {
        return $this->all()->count();
    }

    public function totalPrice(): float
    {
        return round($this->all()->reduce(function ($carry, $item) {
            return $carry + $item->quantity * $item->product->price;
        }), 2);
    }

    public function isNotEmpty(): bool
    {
        return $this->all()->isNotEmpty();
    }

    public function freeQuantity(Product $product): int
    {
        return $product->quantity - $this->get($product)->quantity;
    }

    public function hasFree(Product $product): bool
    {
        return ! ($product->outOfStock() || ($this->has($product) && $this->freeQuantity($product) === 0));
    }
}