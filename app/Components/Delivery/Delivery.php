<?php

namespace AutoKit\Components\Delivery;

use Illuminate\Support\Collection;

abstract class Delivery
{
    protected const UA_ID = 1;
    protected const RU_ID = 2;

    protected const UAH = 100000000;
    protected const RUB = 100000001;

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
     * @var string
     */
    protected $requestMethod;

    public function __construct(DeliveryApiRequest $client)
    {
        $this->client = $client;
        $this->culture = config('delivery.culture');
        $this->country = $this->getCountry();
        $this->requestMethod = 'GET';
        $this->client->setMethod($this->requestMethod);
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
     * @return \Illuminate\Support\Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    protected function send(): Collection
    {
        $response = $this->client->request();
        return $this->client->handle($response);
    }

    protected function prepareQueryData(array $data): array
    {
        return array_merge($data, $this->queryData);
    }

    protected function addQueryData(string $key, $value)
    {
        $this->client->setQueryData($key, $value);
        return $this;
    }

    protected function setUri(string $methodName)
    {
        $this->client->setUri($this->getShortMethodName($methodName));
        return $this;
    }
}