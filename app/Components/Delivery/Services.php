<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Components\Cart\Cart;
use Illuminate\Support\Collection;

class Services extends Delivery
{
    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $citySendId;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $warehouseSendId;

    /**
     * @var string
     */
    private $cityReceiveId;

    /**
     * @var string
     */
    private $warehouseReceiveId;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var string
     */
    private $requestMethod;

    /**
     * @var Cart
     */
    private $cart;

    public function __construct(DeliveryApiRequest $client, Address $address, Cart $cart)
    {
        parent::__construct($client);
        $this->citySendId = config('delivery.city_send_id');
        $this->warehouseSendId = config('delivery.warehouse_send_id');
        $this->address = $address;
        $this->requestMethod = 'GET';
        $this->cart = $cart;
    }

    /**
     * @param string $warehouses
     * @return self
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function setReceiveInfo(string $warehouses): self
    {
        $warehouses = $this->address->getWarehousesInfo($warehouses);
        $this->cityReceiveId = $warehouses->get('CityId');
        $this->warehouseReceiveId = $warehouses->get('id');
        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getDeliveryScheme(): Collection
    {
        return $this->request(
            $this->requestMethod,
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $this->cityReceiveId,
                'WarehouseReceiveId' => $this->warehouseReceiveId
            ]
        );
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getTariffCategory(): Collection
    {
        return $this->request(
            $this->requestMethod,
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $this->cityReceiveId,
                'WarehouseReceiveId' => $this->warehouseReceiveId
            ]
        );
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getDopUslugiClassification(): Collection
    {
        return $this->request(
            $this->requestMethod,
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $this->cityReceiveId,
                'currency' => self::UAH,
            ]
        );
    }

    /**
     * @param string $tarif
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getCargoCategory(string $tarif): Collection
    {
        return $this->request($this->requestMethod, __METHOD__, ['TariffCategoryId' => $tarif]);
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getInsuranceCost(): Collection
    {
        $this->queryData = [];
        return $this->request(
            $this->requestMethod,
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $this->cityReceiveId,
                'WarehouseSendId' => $this->warehouseSendId,
                'WarehouseReceiveId' => $this->warehouseReceiveId,
                'InsuranceValue' => $this->cart->totalPrice(),
                'InsuranceCurrency' => self::UAH
            ]
        );
    }
}