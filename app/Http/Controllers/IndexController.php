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
        return view(
            'main',
            [
                'categories' => $this->category->getForMainPage(),
                'top_products' => $this->product->getForMainPageWhere('is_top'),
                'new_products' => $this->product->getForMainPageWhere('is_new'),
                'articles' => $this->article->getLastForMainPage()
            ]);
    }
}
