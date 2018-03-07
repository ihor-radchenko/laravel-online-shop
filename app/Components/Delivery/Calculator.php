<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use AutoKit\Components\Money\Money;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Calculator extends Delivery
{
    private const MAX_CASH_ON_DELIVERY = 150000;

    private $areasSendId;
    private $areasResiveId;
    private $warehouseSendId;
    private $warehouseResiveId;
    private $insuranceValue;

    /**
     * @var Money
     */
    private $cashOnDeliveryValue;
    private $dateSend;
    private $deliveryScheme;
    private $category;
    private $dopUsluga;

    private $address;
    private $services;

    public function __construct(
        DeliveryApiRequest $client, Address $address, Services $services, Cart $cart, Exchanger $exchanger
    ) {
        parent::__construct($client, $cart, $exchanger);
        $this->address = $address;
        $this->requestMethod = 'POST';
        $this->areasSendId = config('delivery.city_send_id');
        $this->warehouseSendId = config('delivery.warehouse_send_id');
        $this->services = $services;
    }

    /**
     * @return Money
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function postReceiptCalculate(): Money
    {
        $cost = $this
            ->setUri(__METHOD__)
            ->addBodyData('culture', $this->culture)
            ->addBodyData('areasSendId', $this->areasSendId)
            ->addBodyData('areasResiveId', $this->areasResiveId)
            ->addBodyData('warehouseSendId', $this->warehouseSendId)
            ->addBodyData('warehouseResiveId', $this->areasResiveId)
            ->addBodyData('InsuranceValue', $this->insuranceValue)
            ->addBodyData('CashOnDeliveryValue', $this->cashOnDeliveryValue())
            ->addBodyData('dateSend', $this->dateSend)
            ->addBodyData('deliveryScheme', $this->deliveryScheme)
            ->addBodyData('category', $this->category)
            ->addBodyData('dopUslugaClassificator', $this->dopUsluga)
            ->send()
            ->get('allSumma');
        $cost = Money::UAH($cost * Currency::UAH()->getCountSubUnitsInUnit());
        $this->cart->setShipping($cost);
        return $this->exchanger
            ->convert($cost, app(Currency::class));
    }

    private function cashOnDeliveryValue()
    {
        $cash = $this->cashOnDeliveryValue->format();
        if (self::MAX_CASH_ON_DELIVERY < $cash) {
            $cash = self::MAX_CASH_ON_DELIVERY;
        }
        return $cash;
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
     * @param string $category
     * @return Calculator
     */
    public function setCategory(string $category): self
    {
        $this->category = [[
            'categoryId' => $category,
            'countPlace' => 1,
            'helf' => $this->cart->totalWeight(),
            'size' => $this->cart->totalDimensions()
        ]];
        return $this;
    }

    /**
     * @param array $dopUsluga
     * @return Calculator
     */
    public function setDopUsluga(?array $dopUsluga): self
    {
        if (is_null($dopUsluga)) return $this;
        $arr = [];
        foreach ($dopUsluga as $usluga) {
            $arr[] = ['uslugaId' => $usluga, 'count' => 1];
        }
        $this->dopUsluga = [['dopUsluga' => $arr]];
        return $this;
    }

    /**
     * @return Calculator
     * @throws \AutoKit\Exceptions\DeliveryApi
     * @throws \AutoKit\Exceptions\DifferentCurrencies
     */
    public function setInsuranceValue(): self
    {
        $this->services->setReceiveInfo($this->warehouseSendId);
        $this->insuranceValue = $this->services
            ->getInsuranceCost()
            ->add($this->cashOnDeliveryValue)
            ->format();
        return $this;
    }

    /**
     * @return Calculator
     */
    public function setCashOnDeliveryValue(): self
    {
        $this->cashOnDeliveryValue = $this->convertCartPriceToUAH();
        return $this;
    }

    /**
     * @return Calculator
     */
    public function setDateSend(): self
    {
        $this->dateSend = Carbon::tomorrow()->addHours(12)->format('d.m.Y');;
        return $this;
    }
}