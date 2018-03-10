<?php

namespace AutoKit\Http\Controllers;

use Auth;
use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Delivery\Address;
use AutoKit\Components\Money\Currency;
use AutoKit\Components\Stripe\Charge;
use AutoKit\Exceptions\DeliveryApi;
use AutoKit\Exceptions\QuantityOverstated;
use AutoKit\Http\Requests\OrderRequest;
use AutoKit\Order;
use AutoKit\Product;
use Illuminate\Http\Request;
use Lang;

class OrderController extends Controller
{
    /**
     * @var Address
     */
    protected $deliveryAddress;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var Currency
     */
    protected $currency;

    /**
     * @var Charge
     */
    protected $stripe;

    public function __construct(Address $address, Cart $cart, Currency $currency, Charge $charge)
    {
        $this->deliveryAddress = $address;
        $this->cart = $cart;
        $this->currency = $currency;
        $this->stripe = $charge;
    }

    public function index()
    {
        return view('order');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function selfDelivery()
    {
        $this->cart->setShipping(null);
        try {
            $selfDelivery = $this->deliveryAddress->getWarehousesInfo(config('delivery.warehouse_send_id'));
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.self_delivery')
                ->with('warehouse', $selfDelivery)
                ->render(),
            'totalPrice' => $this->cart->totalPrice()->format()
        ]);
    }

    /**
     * @param OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \AutoKit\Exceptions\DifferentCurrencies
     */
    public function store(OrderRequest $request)
    {
        try {
            $this->cart->purchaseProducts();
        } catch (QuantityOverstated $e) {
            $product = Product::find($e->getMessage());
            session()->flash('message', Lang::get('flash.quantity_overstated', ['name' => $product->title, 'qty' => $product->quantity]));
            return redirect()->route('cart');
        }
        $order = Auth::check()
            ? $request->user()->orders()->create($request->all())
            : Order::create($request->all());
        $charge = $this->stripe->charge($order, $request->stripeToken);
        $order->confirmPayment($charge);
        $this->cart->clear();
        return Auth::check()
            ? redirect()->route('home')
            : redirect()->route('main');
    }
}
