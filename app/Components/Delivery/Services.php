<?php

namespace AutoKit\Components\Delivery;

use Illuminate\Support\Collection;

class Services extends Delivery
{
    private const UAH = 100000000;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $citySendId;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var string
     */
    private $requestMethod;

    public function __construct(DeliveryApiRequest $client, Address $address)
    {
        parent::__construct($client);
        $this->citySendId = config('delivery.city_send_id');
        $this->address = $address;
        $this->requestMethod = 'GET';
    }

    /**
     * @param string $warehouses
     * @return \Illuminate\Support\Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getDeliveryScheme(string $warehouses): Collection
    {
        $warehouses = $this->address->getWarehousesInfo($warehouses);
        return $this->request(
            'GET',
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $warehouses->get('CityId'),
                'WarehouseReceiveId' => $warehouses->get('id')
            ]
        );
    }

    /**
     * @param string $warehouses
     * @return \Illuminate\Support\Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getTariffCategory(string $warehouses): Collection
    {
        $warehouses = $this->address->getWarehousesInfo($warehouses);
        return $this->request(
            'GET',
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $warehouses->get('CityId'),
                'WarehouseReceiveId' => $warehouses->get('id')
            ]
        );
    }

    /**
     * @param string $city
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getDopUslugiClassification(string $city)
    {
        return $this->request(
            'GET',
            __METHOD__,
            [
                'CitySendId' => $this->citySendId,
                'CityReceiveId' => $city,
                'currency' => self::UAH,
            ]
        );
    }
}