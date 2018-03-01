<?php

namespace AutoKit\Http\Controllers\Order;

use AutoKit\Components\Delivery\Address;
use AutoKit\Components\Delivery\Services;
use AutoKit\Exceptions\DeliveryApi;
use AutoKit\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * @var Address
     */
    protected $deliveryAddress;

    /**
     * @var Services
     */
    protected $deliveryServices;

    /**
     * @var Request
     */
    protected $request;

    /**
     * DeliveryController constructor.
     * @param Request $request
     * @param Address $address
     * @param Services $services
     * @throws DeliveryApi
     */
    public function __construct(Request $request, Address $address, Services $services)
    {
        $this->middleware('order');
        $this->deliveryAddress = $address;
        $this->deliveryServices = $services;
        $this->request = $request;
        if ($request->has('warehouse')) {
            $this->deliveryServices->setReceiveInfo($request->warehouse);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function delivery()
    {
        try {
            $regions = $this->deliveryAddress->getRegionList();
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.address')
                ->with('regions', $regions)
                ->render()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function region()
    {
        try {
            $cities = $this->deliveryAddress->getAreasList($this->request->region);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.item_list')
                ->with('items', $cities)
                ->render()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function city()
    {
        try {
            $warehouses = $this->deliveryAddress->getWarehousesListInDetail($this->request->city, 25);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.item_list')
                ->with('items', $warehouses)
                ->render()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function warehouse()
    {
        try {
            $additionalServices = $this->deliveryServices->getDopUslugiClassification();
            $tarif = $this->deliveryServices->getTariffCategory();
            $deliveryScheme = $this->deliveryServices->getDeliveryScheme();
            $warehouse = $this->deliveryAddress->getWarehousesInfo($this->request->warehouse);
            $insuranceCost = $this->deliveryServices->getInsuranceCost();
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.warehouse')
                ->with('warehouse', $warehouse)
                ->with('schemes', $deliveryScheme)
                ->with('tarifs', $tarif)
                ->with('additionalServices', $additionalServices)
                ->with('insuranceCost', $insuranceCost)
                ->render()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function category()
    {
        try {
            $categories = $this->deliveryServices->getCargoCategory($this->request->tarif);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.categories')
                ->with('categories', $categories)
                ->render()
        ]);
    }
}
