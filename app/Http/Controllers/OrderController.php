<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Components\Delivery\Address;
use AutoKit\Exceptions\DeliveryApi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $deliveryAddress;

    public function __construct(Address $address)
    {
        $this->deliveryAddress = $address;
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
        try {
            $selfDelivery = $this->deliveryAddress->getWarehousesInfo(config('delivery.warehouse_send_id'));
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.self_delivery')
                ->with('warehouse', $selfDelivery)
                ->render()
        ]);
    }
}
