<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Components\Delivery\Address;
use AutoKit\Exceptions\DeliveryApi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->middleware('order');
        $this->address = $address;
    }

    public function index()
    {
        return view('order');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function delivery(Request $request)
    {
        if ($request->delivery === 'on') {
            try {
                $regions = $this->address->getRegionList();
            } catch (DeliveryApi $e) {
                return response()->json(['message' => $e->getMessage()], 501);
            }
            return response()->json([
                'content' => view('partials.order.form.address', ['regions' => $regions])->render()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function region(Request $request)
    {
        try {
            $cities = $this->address->getAreasList($request->region);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.item_list', ['items' => $cities])->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function city(Request $request)
    {
        try {
            $warehouses = $this->address->getWarehousesListInDetail($request->city, 25);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.item_list', ['items' => $warehouses])->render()
        ]);
    }
}
