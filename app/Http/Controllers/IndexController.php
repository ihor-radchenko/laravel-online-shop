<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Article;
use AutoKit\Category;
use AutoKit\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Article
     */
    protected $article;

    public function __construct(Category $category, Product $product, Article $article)
    {
        $this->category = $category;
        $this->product = $product;
        $this->article = $article;
    }

    public function index()
    {
        return view('main')
            ->with('categories', $this->category->getForMainPage())
            ->with('top_products', $this->product->getForMainPageWhere('is_top'))
            ->with('new_products', $this->product->getForMainPageWhere('is_new'))
            ->with('articles', $this->article->getLastForMainPage());
    }

    public function changeCurrency(string $currency)
    {
        return back()->withCookie(cookie()->forever('currency', strtoupper($currency)));
    }
}
