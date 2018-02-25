<?php

namespace AutoKit;

use AutoKit\Components\Cart\Cart;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Review[] $reviews
 */
class Product extends Model
{
    protected $perPage = 6;

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
        if (preg_match('~^http~', $value)) {
            return $value;
        }
        return '/img/products/' . $value;
    }

    public function outOfStock(): bool
    {
        return $this->quantity === 0;
    }

    public function hasLowStock(): bool
    {
        return $this->quantity > 0 && $this->quantity < 10;
    }

    public function hasStock(int $quantity): bool
    {
        return $this->quantity >= $quantity;
    }

    public function hasFreeStock(Cart $cart): bool
    {
        return ! ($this->outOfStock() || ($cart->has($this) && $cart->freeQuantity($this) === 0));
    }

    /**
     * @param string $field is_top|is_new
     * @return Collection
     */
    public function getForMainPageWhere(string $field): Collection
    {
        return self::where($field, 1)
            ->with('reviews')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    /**
     * @param Menu $menu
     * @param null|string $brand
     * @param string $orderBy
     * @param string $column
     * @param array|null $price
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWhereMenu(Menu $menu, ?string $brand = null, string $orderBy = 'desc', string $column = 'id', ?array $price = null)
    {
        $data = self::whereIn(
            'category_id',
            Category::select('id')
                ->whereMenuId($menu->id)
                ->get()
            )
            ->with('reviews')
            ->orderBy($column, $orderBy);
        if ($brand) {
            $data->whereBrandId(Brand::whereAlias($brand)->first()->id);
        }
        if ($price) {
            $data->whereBetween('price', [trim($price['min'], '$'), trim($price['max'], '$')]);
        }
        return $data->paginate();
    }

    /**
     * @param Category $category
     * @param null|string $brand
     * @param string $orderBy
     * @param string $column
     * @param array|null $price
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWhereCategory(Category $category, ?string $brand = null, string $orderBy = 'desc', string $column = 'id', ?array $price = null)
    {
        $data = self::whereCategoryId($category->id)
            ->with('reviews')
            ->orderBy($column, $orderBy);
        if ($brand) {
            $data->whereBrandId(Brand::whereAlias($brand)->first()->id);
        }
        if ($price) {
            $data->whereBetween('price', [trim($price['min'], '$'), trim($price['max'], '$')]);
        }
        return $data->paginate();
    }

    /**
     * @param Menu $menu
     * @param Category|null $category
     * @return float
     */
    public function getMaxPrice(Menu $menu, ?Category $category = null): float
    {
        $data = self::whereIn(
            'category_id',
            Category::select('id')
                ->whereMenuId($menu->id)
                ->get()
        );
        if ($category) {
            $data->whereCategoryId($category->id);
        }
        return ceil($data->max('price'));
    }
}
