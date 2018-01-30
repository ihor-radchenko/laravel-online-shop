<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Brand;
use AutoKit\Category;
use AutoKit\Menu;
use AutoKit\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @var Brand
     */
    protected $brand;

    public function __construct(Product $product, Category $category, Menu $menu, Brand $brand)
    {
        $this->product = $product;
        $this->category = $category;
        $this->menu = $menu;
        $this->brand = $brand;
    }

    public function index(Menu $menu)
    {
        return view(
            'products',
            [
                'breadcrumb' => $menu->load('products.brand'),
                'products' => $this->product->getWhereMenu($menu),
                'categories' => $this->category->getWhereMenu($menu),
                'productsBrand' => $menu->products
            ]
        );
    }

    public function showByCategory(Menu $menu, Category $category)
    {
        $menu->load('products.brand');
        return view(
            'products',
            [
                'breadcrumb' => $category->load('menu'),
                'products' => $this->product->getWhereCategory($category),
                'categories' => $this->category->getWhereMenu($menu),
                'productsBrand' => $menu->products
            ]
        );
    }

    public function showByBrand(Brand $brand)
    {
        return view(
            'products',
            [
                'breadcrumb' => $brand,
                'products' => $this->product->getWhereBrand($brand),
                'menus' => $this->menu->getWithCountProducts(),
                'brands' => $this->brand->getWithCountProducts()
            ]
        );
    }

    public function show(Product $product)
    {
        return view('product', ['product' => $product->load('reviews.user')]);
    }
}