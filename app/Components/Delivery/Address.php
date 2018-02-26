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
    private const PACKSTATION_MAX_WEIGHT = 30;

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getRegionList(): Collection
    {
        return $this->request(__METHOD__, ['country' => $this->country])
            ->where('id', '>=', 0);
    }

    /**
     * @param int $region
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getAreasList(int $region): Collection
    {
        return $this->request(__METHOD__, ['country' => $this->country, 'fl_all' => true, 'regionId' => $region]);
    }

    /**
     * @param string $city
     * @param float $weight
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getWarehousesListInDetail(string $city, float $weight): Collection
    {
        $response = $this->request(__METHOD__, ['country' => $this->country, 'cityId' => $city]);
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
    public function getWarehousesInfo(string $warehouses): Collection
    {
        return $this->request(__METHOD__, ['WarehousesId' => $warehouses]);
    }

    private function affordablePackstation(float $weight): bool
    {
        return $weight < self::PACKSTATION_MAX_WEIGHT;
    }
}