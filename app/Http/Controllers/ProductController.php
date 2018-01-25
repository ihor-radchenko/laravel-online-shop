<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Menu;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(string $parent_category)
    {
        return view(
            'products',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'menu' => Menu::whereAlias($parent_category)->with('products.brand', 'categories')->first(),
            ]
        );
    }
}
