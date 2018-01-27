<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Category;
use AutoKit\Menu;
use AutoKit\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(string $parentCategory)
    {
        $menu = Menu::whereAlias($parentCategory)->with('products.brand')->first();
        return view(
            'products',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'menu' => $menu,
                'breadcrumb' => $menu,
                'products' => Product::whereIn('category_id',  Category::select('id')->whereMenuId($menu->id)->get())->orderByDesc('id')->get(),
                'categories' => Category::whereMenuId($menu->id)->with('menu')->withCount('products')->get()
            ]
        );
    }

    public function showByCategory(string $parentCategory, string $category)
    {
        $menu = Menu::whereAlias($parentCategory)->with('products.brand')->first();
        return view(
            'products',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'menu' => $menu,
                'breadcrumb' => Category::whereAlias($category)->with('menu')->first(),
                'products' => Product::whereCategoryId(Category::whereAlias($category)->first()->id)->orderByDesc('id')->get(),
                'categories' => Category::whereMenuId($menu->id)->with('menu')->withCount('products')->get()
            ]
        );
    }
}