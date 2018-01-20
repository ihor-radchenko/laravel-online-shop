<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title', 'alias'
    ];
}