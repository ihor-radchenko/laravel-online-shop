<?php

namespace AutoKit\Components\Stripe;

use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Money;
use Stripe\ApiResource;
use Stripe\Charge;
use Stripe\Stripe;

class ChargeRequest
{
    /**
     * @var array
     */
    private $metadata;

    /**
     * @var array
     */
    private $requestData;

    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret_key'));
    }

    /**
     * @return \Stripe\ApiResource
     */
    public function create(): ApiResource
    {
        return Charge::create($this->requestData);
    }

    public function addMetaData(string $key, $value): self
    {
        $this->metadata[$key] = $value;
        return $this;
    }

    public function setAmount(Money $value): self
    {
        $this->requestData['amount'] = $value->getAmount();
        return $this;
    }

    public function setCurrency(Currency $value): self
    {
        $this->requestData['currency'] = $value->getIsoAlfa();
        return $this;
    }

    public function setDescription(string $value): self
    {
        $this->requestData['description'] = $value;
        return $this;
    }

    public function setToken(string $value): self
    {
        $this->requestData['source'] = $value;
        return $this;
    }

    public function setMetadata(): self
    {
        $this->requestData['metadata'] = $this->metadata;
        return $this;
    }
}