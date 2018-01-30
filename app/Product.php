<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * AutoKit\Product
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property float|null $old_price
 * @property int $quantity
 * @property int $is_top
 * @property int $is_new
 * @property string $img
 * @property string $description
 * @property int $category_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $brand_id
 * @property-read \AutoKit\Brand $brand
 * @property-read \AutoKit\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'title', 'price', 'old_price', 'quantity', 'description', 'is_top', 'is_new', 'img', 'category_id', 'brand_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImgAttribute(string $value): string
    {
        return '/img/products/' . $value;
    }

    /**
     * @param string $field is_top|is_new
     * @return Collection
     */
    public function getForMainPageWhere(string $field): Collection
    {
        return self::where($field, 1)->with('reviews')->inRandomOrder()->take(4)->get();
    }

    /**
     * @param Menu $menu
     * @return Collection
     */
    public function getWhereMenu(Menu $menu): Collection
    {
        return self::whereIn('category_id',  Category::select('id')->whereMenuId($menu->id)->get())->with('reviews')->orderByDesc('id')->get();
    }

    /**
     * @param Category $category
     * @return Collection
     */
    public function getWhereCategory(Category $category): Collection
    {
        return self::whereCategoryId($category->id)->with('reviews')->orderByDesc('id')->get();
    }

    /**
     * @param Brand $brand
     * @return Collection
     */
    public function getWhereBrand(Brand $brand): Collection
    {
        return self::whereBrandId($brand->id)->with('reviews')->orderByDesc('id')->get();
    }
}
