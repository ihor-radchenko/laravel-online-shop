<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use AutoKit\Components\Money\Money;
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

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var Exchanger
     */
    protected $exchanger;

    public function __construct(DeliveryApiRequest $client, Cart $cart, Exchanger $exchanger)
    {
        $this->client = $client;
        $this->cart = $cart;
        $this->exchanger = $exchanger;
        $this->culture = config('delivery.culture');
        $this->country = $this->getCountry();
        $this->requestMethod = 'GET';
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
        $response = $this->client
            ->setMethod($this->requestMethod)
            ->request();
        return $this->client->handle($response);
    }

    protected function addQueryData(string $key, $value)
    {
        $this->client->setQueryData($key, $value);
        return $this;
    }

    protected function addBodyData(string $key, $value)
    {
        $this->client->setBodyData($key, $value);
        return $this;
    }

    protected function setUri(string $methodName)
    {
        $this->client->setUri($this->getShortMethodName($methodName));
        return $this;
    }

    protected function convertCartPriceToUAH(): Money
    {
        return $this->exchanger->convert($this->cart->totalPrice(), Currency::UAH());
    }
}