<?php

namespace AutoKit\Observers;

use AutoKit\Components\Cart\Cart;
use AutoKit\Http\Requests\OrderRequest;
use AutoKit\Order;

class OrderObserver
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var Cart
     */
    private $cart;

    public function __construct(OrderRequest $request, Cart $cart)
    {
        $this->data = $request->all();
        $this->cart = $cart;
    }

    public function creating(Order $order)
    {
        $order->cart = serialize($this->cart->all());
        $order->is_self_delivery = $this->data['delivery'] === 'on' ? false : true;
        $order->shipping_price = $this->data['delivery'] === 'on' ? $this->cart->getShippingInUSD()->getAmount() : 0;
        $order->warehouse = $this->data['warehouse_id'] ?? null;
    }
}