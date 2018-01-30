<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'text', 'rating', 'name', 'user_id', 'product_id'
    ];

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
