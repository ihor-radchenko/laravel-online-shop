<?php

namespace AutoKit\Components\Delivery;

use Illuminate\Support\Collection;

abstract class Delivery
{
    protected const UA_ID = 1;
    protected const RU_ID = 2;

    /**
     * @var DeliveryApiRequest
     */
    protected $client;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $culture;

    /**
     * @var int
     */
    protected $country;

    /**
     * @var array
     */
    protected $queryData;

    public function __construct(DeliveryApiRequest $client)
    {
        $this->client = $client;
        $this->culture = config('delivery.culture');
        $this->country = $this->getCountry();
        $this->queryData = ['culture' => $this->culture];
    }

    protected function getCountry(): int
    {
        $country = config('delivery.country');
        switch ($country) {
            case 'UA':
                return self::UA_ID;
            case 'RU':
                return self::RU_ID;
            default:
                return self::UA_ID;
        }
    }

    protected function getShortMethodName(string $fullMethodName): string
    {
        return ucfirst(preg_replace('~.*?::([a-zA-Z]+)~', '$1', $fullMethodName));
    }

    /**
     * @param string $methodName
     * @param array $data
     * @return \Illuminate\Support\Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    protected function request(string $requestMethod,string $methodName, array $data): Collection
    {
        $response = $this->client
            ->setMethod($requestMethod)
            ->createUri($this->getShortMethodName($methodName))
            ->createQueryData($this->prepareQueryData($data))
            ->request();
        return $this->client->handle($response);
    }

    protected function prepareQueryData(array $data): array
    {
        return array_merge($data, $this->queryData);
    }
}