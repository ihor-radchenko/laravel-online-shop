<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 25.02.2018
 * Time: 17:17
 */

namespace AutoKit\Components\Delivery;

use Illuminate\Support\Collection;

class Address extends Delivery
{
    private const PACKSTATION = 2;

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getRegionList()
    {
        $response = $this->request(
            $this->createUrl(__METHOD__),
            [
                'culture' => $this->culture,
                'country' => $this->country
            ]
        );
        return $this->handle($response)->where('id', '>=', 0);
    }

    /**
     * @param int $region
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getAreasList(int $region)
    {
        $response = $this->request(
            $this->createUrl(__METHOD__),
            [
                'culture' => $this->culture,
                'country' => $this->country,
                'fl_all' => true,
                'regionId' => $region
            ]
        );
        return $this->handle($response);
    }

    /**
     * @param string $city
     * @param float $weight
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getWarehousesListInDetail(string $city, float $weight)
    {
        $response = $this->request(
            $this->createUrl(__METHOD__),
            [
                'culture' => $this->culture,
                'country' => $this->country,
                'cityId' => $city
            ]
        );
        $response = $this->handle($response);
        if ($this->affordablePackstation($weight)) {
            return $response;
        }
        return $response->where('WarehouseType', '<>', self::PACKSTATION);
    }

    /**
     * @param string $warehouses
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getWarehousesInfo(string $warehouses)
    {
        $response = $this->request(
            $this->createUrl(__METHOD__),
            [
                'culture' => $this->culture,
                'WarehousesId' => $warehouses
            ]
        );
        return $this->handle($response);
    }

    private function affordablePackstation(float $weight): bool
    {
        return $weight < 30;
    }
}