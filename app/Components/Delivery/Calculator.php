<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Components\Cart\Cart;
use Carbon\Carbon;

class Calculator extends Delivery
{
    private $areasSendId;
    private $areasResiveId;
    private $warehouseSendId;
    private $warehouseResiveId;
    private $insuranceValue;
    private $cashOnDeliveryValue;
    private $dateSend;
    private $deliveryScheme;
    private $category;
    private $dopUsluga;

    private $address;
    private $services;

    public function __construct(DeliveryApiRequest $client, Address $address, Services $services, Cart $cart)
    {
        parent::__construct($client);
        $this->address = $address;
        $this->requestMethod = 'POST';
        $this->areasSendId = config('delivery.city_send_id');
        $this->warehouseSendId = config('delivery.warehouse_send_id');
        $this->dateSend = Carbon::tomorrow()->addHours(12)->format('d.m.Y');
        $this->cashOnDeliveryValue = $cart->totalPrice();
        $this->services = $services;
    }

    /**
     * @param string $warehouses
     * @return Calculator
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function setReceiveInfo(string $warehouses): self
    {
        $warehouses = $this->address->getWarehousesInfo($warehouses);
        $this->areasResiveId = $warehouses->get('CityId');
        $this->warehouseResiveId = $warehouses->get('id');
        return $this;
    }

    /**
     * @param $deliveryScheme
     * @return Calculator
     */
    public function setDeliveryScheme($deliveryScheme): self
    {
        $this->deliveryScheme = $deliveryScheme;
        return $this;
    }

    /**
     * @param array $category
     * @return Calculator
     */
    public function setCategory(array $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param array $dopUsluga
     * @return Calculator
     */
    public function setDopUsluga(array $dopUsluga): self
    {
        $this->dopUsluga = $dopUsluga;
        return $this;
    }

    /**
     * @return Calculator
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function setInsuranceValue(): self
    {
        $this->services->setReceiveInfo($this->warehouseSendId);
        $this->insuranceValue = $this->services->getInsuranceCost();
        return $this;
    }
}