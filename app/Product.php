<?php

namespace AutoKit;

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
        return $this->belongsTo('AutoKit\Category');
    }

    public function brand()
    {
        return $this->belongsTo('AutoKit\Brand');
    }

    public function getImgAttribute(string $value): string
    {
        return '/img/products/' . $value;
    }
}
