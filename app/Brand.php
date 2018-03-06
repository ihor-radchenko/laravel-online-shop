<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

/**
 * AutoKit\Brand
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand getForCategoryWithCountProducts(\AutoKit\Category $category)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Brand getForMenuWithCountProducts(\AutoKit\Menu $menu)
 */
class Brand extends Model
{
    protected $fillable = [
        'title', 'alias'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeGetForMenuWithCountProducts($query, Menu $menu)
    {
        return $query
            ->whereIn('brands.id', $menu->products->pluck('brand_id')->unique())
            ->withCount(['products' => function ($query) use ($menu) {
                $query
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('categories.menu_id', $menu->id);
            }])
            ->get();
    }

    public function scopeGetForCategoryWithCountProducts($query, Category $category)
    {
        return $query
            ->whereIn('brands.id', $category->products->pluck('brand_id')->unique())
            ->withCount(['products' => function ($query) use ($category) {
                $query->where('category_id', $category->id);
            }])
            ->get();
    }
}
