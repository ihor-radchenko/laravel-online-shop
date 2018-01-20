<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Category;
use AutoKit\Menu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view(
            'main',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'categories' => Category::where('img', '<>', null)->with('menu')->get()
            ]);
    }
}
