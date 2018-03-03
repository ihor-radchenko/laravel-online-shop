<?php

namespace AutoKit\Components\Money;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class ExchangeRequest
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $uri;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->uri = config('money.uri');
    }

    public function getCurrencyRates(): Collection
    {
        $response = $this->request();
        return $this->handle($response);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function request(): ResponseInterface
    {
        return $this->client->get($this->uri);
    }

    private function handle(ResponseInterface $response): Collection
    {
        $content = $this->getContent($response);
        $content = json_decode($content);
        return collect($content);
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private function getContent(ResponseInterface $response)
    {
        return $response
            ->getBody()
            ->getContents();
    }
}