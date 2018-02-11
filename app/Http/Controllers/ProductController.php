<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Brand;
use AutoKit\Category;
use AutoKit\Menu;
use AutoKit\Product;
use AutoKit\Review;
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

    /**
     * @var Review
     */
    protected $review;

    public function __construct(Product $product, Category $category, Menu $menu, Brand $brand, Review $review)
    {
        $this->product = $product;
        $this->category = $category;
        $this->menu = $menu;
        $this->brand = $brand;
        $this->review = $review;
    }

    public function index(Request $request, Menu $menu)
    {
        if ($request->ajax()) {
            return view('partials.products.grid', ['products' => $this->product->getWhereMenu($menu)]);
        }
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

    public function showByCategory(Request $request, Menu $menu, Category $category)
    {
        if ($request->ajax()) {
            return view('partials.products.grid', ['products' => $this->product->getWhereCategory($category)]);
        }
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

    public function showByBrand(Request $request, Brand $brand)
    {
        if ($request->ajax()) {
            return view('partials.products.grid', ['products' => $this->product->getWhereBrand($brand)]);
        }
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

    public function show(Request $request, Product $product)
    {
        if ($request->ajax()) {
            return view('partials.product.reviews_list', ['reviews' => $this->review->getForProduct($product, $request->page)]);
        }
        return view('product',
            [
                'product' => $product->load('reviews'),
                'reviews' => $this->review->getForProduct($product),
                'maxOffset' => $this->review->getMaxOffset($product)
            ]
        );
    }
}