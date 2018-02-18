<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Components\Cart\Cart;
use AutoKit\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('cart');
    }

    public function add(Request $request)
    {
        $this->cart->add(Product::find($request->product), $request->quantity);
        return response()->json([
            'totalQuantity' => $this->cart->totalQuantity()
        ]);
    }
}
