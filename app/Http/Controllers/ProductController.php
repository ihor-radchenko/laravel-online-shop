<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Category;
use AutoKit\Menu;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(string $parent_category)
    {
        $menu = Menu::whereAlias($parent_category)->with('products.brand')->first();
        return view(
            'products',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'menu' => $menu,
                'products' => $menu->products,
                'categories' => Category::whereMenuId($menu->id)->withCount('products')->get()
            ]
        );
    }
}
