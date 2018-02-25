<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Exceptions\DeliveryApi;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

abstract class Delivery
{
    /**
     * @var Client
     */
    protected $client;

    protected $culture;

    protected $country;

    protected $url;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->culture = config('delivery.culture');
        $this->country = $this->getCountry();
        $this->url = 'http://www.delivery-auto.com/api/v4/Public/';
    }

    protected function getCountry(): int
    {
        $country = config('delivery.country');
        switch ($country) {
            case 'UA':
                return 1;
            case 'RU':
                return 2;
            default:
                return 1;
        }
    }

    protected function getShortMethodName(string $fullMethodName): string
    {
        return ucfirst(preg_replace('~.*?::([a-zA-Z]+)~', '$1', $fullMethodName));
    }

    protected function createUrl(string $methodName): string
    {
        return $this->url . $this->getShortMethodName($methodName);
    }

    /**
     * @param $response
     * @return Collection
     * @throws DeliveryApi
     */
    protected function handle($response): Collection
    {
        $response = json_decode($response);
        if ($response->status === false) {
            throw new DeliveryApi($response->message);
        }
        return collect($response->data);
    }

    protected function request(string $uri, array $query)
    {
        return $this->client->get($uri, ['query' => $query])
            ->getBody()
            ->getContents();
    }
}