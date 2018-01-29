<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 29.01.2018
 * Time: 18:07
 */

namespace AutoKit\Http\ViewComposers;

use AutoKit\Menu;
use Illuminate\View\View;

class NavComposer
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function compose(View $view)
    {
        $view->with('menu_navigation', $this->menu->getNavBar());
    }
}