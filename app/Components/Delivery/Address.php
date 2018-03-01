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
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('country', $this->country)
            ->addQueryData('culture', $this->culture)
            ->send()
            ->where('id', '>=', 0)
            ->filter(function ($item) {
                return ! preg_match('~.*?АТО~', $item->name);
            });
    }

    /**
     * @param int $region
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getAreasList(int $region): Collection
    {
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('country', $this->country)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('fl_all', true)
            ->addQueryData('regionId', $region)
            ->send();
    }

    /**
     * @param string $city
     * @param float $weight
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function getWarehousesListInDetail(string $city, float $weight): Collection
    {
        $response = $this
            ->setUri(__METHOD__)
            ->addQueryData('country', $this->country)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('cityId', $city)
            ->send();
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
        return $this
            ->setUri(__METHOD__)
            ->addQueryData('culture', $this->culture)
            ->addQueryData('WarehousesId', $warehouses)
            ->send();
    }

    private function affordablePackstation(float $weight): bool
    {
        return $weight < self::PACKSTATION_MAX_WEIGHT;
    }
}