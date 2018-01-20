<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Menu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view(
            'main',
            [
                'menu_navigation' => Menu::all()
            ]);
    }
}
