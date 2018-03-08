<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

/**
 * AutoKit\Menu
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Menu whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Menu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Product[] $products
 */
class Menu extends Model
{
    protected $fillable = [
        'title', 'alias'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class);
    }

    public function getNavBar()
    {
        return $this
            ->with('categories')
            ->get();
    }

    public function getWithCountProducts()
    {
        return $this
            ->withCount('products')
            ->has('products')
            ->get();
    }
}
