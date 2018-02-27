<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Exceptions\DeliveryApi;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class DeliveryApiRequest
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $queryData;

    /**
     * @var string
     */
    private $method;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->uri = 'http://www.delivery-auto.com/api/v4/Public/';
        $this->queryData = ['query' => []];
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(): ResponseInterface
    {
        return $this->client->request($this->method, $this->uri, $this->queryData);
    }

    /**
     * @param ResponseInterface $response
     * @return Collection
     * @throws DeliveryApi
     */
    public function handle(ResponseInterface $response): Collection
    {
        $content = $this->getContent($response);
        if ($this->hasError($content)) {
            throw new DeliveryApi($content->message);
        }
        return collect($content->data);
    }

    public function createUri(string $methodName): self
    {
        $this->uri = 'http://www.delivery-auto.com/api/v4/Public/';
        $this->uri .= $methodName;
        return $this;
    }

    public function createQueryData(array $queryData): self
    {
        $this->queryData = ['query' => $queryData];
        return $this;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    private function hasError($content): bool
    {
        return $content->status === false;
    }

    private function getContent(ResponseInterface $response)
    {
        $content = $response
            ->getBody()
            ->getContents();
        return json_decode($content);
    }
}