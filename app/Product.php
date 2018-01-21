<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'price', 'old_price', 'quantity', 'description', 'is_top', 'is_new', 'img', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('AutoKit\Category');
    }

    public function getImgAttribute(string $value): string
    {
        return '/img/products/' . $value;
    }
}
