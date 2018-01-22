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
 */
class Brand extends Model
{
    protected $fillable = [
        'title', 'alias'
    ];

    public function products()
    {
        return $this->hasMany('AutoKit\Product');
    }
}
