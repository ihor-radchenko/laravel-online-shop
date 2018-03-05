<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use AutoKit\Components\Money\Money;
use Carbon\Carbon;
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

    public function __construct(DeliveryApiRequest $client, Address $address, Cart $cart, Exchanger $exchanger)
    {
        parent::__construct($client, $cart, $exchanger);
        $this->citySendId = config('delivery.city_send_id');
        $this->warehouseSendId = config('delivery.warehouse_send_id');
        $this->address = $address;
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
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('CitySendId', $this->citySendId)
            ->addQueryData('CityReceiveId', $this->cityReceiveId)
            ->addQueryData('WarehouseReceiveId', $this->warehouseReceiveId)
            ->send();
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getTariffCategory(): Collection
    {
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('CitySendId', $this->citySendId)
            ->addQueryData('CityReceiveId', $this->cityReceiveId)
            ->addQueryData('WarehouseReceiveId', $this->warehouseReceiveId)
            ->send();
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getDopUslugiClassification(): Collection
    {
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('CitySendId', $this->citySendId)
            ->addQueryData('CityReceiveId', $this->cityReceiveId)
            ->addQueryData('currency', self::UAH)
            ->send();
    }

    /**
     * @param string $tarif
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getCargoCategory(string $tarif): Collection
    {
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('TariffCategoryId', $tarif)
            ->send();
    }

    /**
     * @return Money
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getInsuranceCost(): Money
    {
        $cost = $this
            ->setUri(__METHOD__)
            ->addQueryData('CitySendId', $this->citySendId)
            ->addQueryData('CityReceiveId', $this->cityReceiveId)
            ->addQueryData('WarehouseSendId', $this->warehouseSendId)
            ->addQueryData('WarehouseReceiveId', $this->warehouseReceiveId)
            ->addQueryData('InsuranceValue', $this->convertCartPriceToUAH()->format())
            ->addQueryData('InsuranceCurrency', self::UAH)
            ->addQueryData('currency', self::UAH)
            ->send()
            ->get('Value');
        return Money::UAH($cost * Currency::UAH()->getCountSubUnitsInUnit());
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getDateArrival(): Collection
    {
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('areasSendId', $this->citySendId)
            ->addQueryData('areasResiveId', $this->cityReceiveId)
            ->addQueryData('dateSend', Carbon::tomorrow()->addHours(12)->format('d.m.Y'))
            ->addQueryData('currency', self::UAH)
            ->addQueryData('warehouseSendId', $this->warehouseSendId)
            ->addQueryData('warehouseResiveId', $this->warehouseReceiveId)
            ->send();
    }
}