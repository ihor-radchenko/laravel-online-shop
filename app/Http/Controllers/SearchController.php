<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var Product
     */
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $result = $this->product->search($request->q);
        return $result->count() === 1
            ? redirect()->route('product', ['product' => $result->first()->id])
            : view('search')
                ->with('searchQuery', $request->q)
                ->with('products', $result);
    }

    public function search(Request $request)
    {
        $result = $this->product->searchTooltips($request->term);
        return response()->json($result);
    }
}
