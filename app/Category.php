<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'alias', 'menu_id'
    ];

    public function menu()
    {
        return $this->belongsTo('AutoKit\Menu');
    }

    public function products()
    {
        return $this->hasMany('AutoKit\Product');
    }

    public function getImgAttribute(string $value): string
    {
        return '/img/categories/' . $value;
    }
}
