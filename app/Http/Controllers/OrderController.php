<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Delivery\Address;
use AutoKit\Components\Money\Currency;
use AutoKit\Exceptions\DeliveryApi;
use Illuminate\Http\Request;
use Lang;
use Stripe\Charge;
use Stripe\Stripe;

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

    public function __construct(Address $address, Cart $cart, Currency $currency)
    {
        $this->deliveryAddress = $address;
        $this->cart = $cart;
        $this->currency = $currency;
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
     * @param Request $request
     * @throws \AutoKit\Exceptions\DifferentCurrencies
     */
    public function store(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret_key'));
        $charge = Charge::create([
            'amount' => $this->cart->totalPriceWithShipping()->getAmount(),
            'currency' => $this->currency->getIsoAlfa(),
            'description' => Lang::get('payment.description'),
            'source' => $request->stripeToken
        ]);
    }
}
