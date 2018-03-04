<?php

namespace AutoKit\Components\Cart;

use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use AutoKit\Components\Money\Money;
use AutoKit\Exceptions\QuantityOverstated;
use AutoKit\Product;
use AutoKit\Repositories\Cart\RepositoryContract as Repository;
use Illuminate\Support\Collection;

class Cart
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var CartItemCreator
     */
    private $creator;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(Repository $repository, CartItemCreator $creator, Currency $currency)
    {
        $this->repository = $repository;
        $this->creator = $creator;
        $this->currency = $currency;
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

    public function totalPrice(): Money
    {
        return $this->all()->reduce(function ($carry, $item) {
            return $carry->add($item->product->price->mul($item->quantity));
        }, new Money(0, $this->currency));
    }

    public function isNotEmpty(): bool
    {
        return $this->all()->isNotEmpty();
    }

    public function freeQuantity(Product $product): int
    {
        return $product->quantity - $this->get($product)->quantity;
    }

    public function totalWeight(): float
    {
        return round_up($this->all()->reduce(function ($carry, $item) {
            return $carry + $item->quantity * $item->product->weight;
        }), 3);
    }

    public function totalDimensions(): float
    {
        return round_up($this->all()->reduce(function ($carry, $item) {
            return $carry + $item->quantity * ($item->product->width * $item->product->height * $item->product->length);
        }), 2);
    }
}