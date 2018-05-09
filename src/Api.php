<?php

namespace Gietos\Dadata;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use Http\Message\StreamFactory;
use Http\Message\UriFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Api
{
    /**
     * @var string
     */
    private $version = 'v2';

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var StreamFactory
     */
    private $streamFactory;

    /**
     * @var UriFactory
     */
    private $uriFactory;

    public function __construct(
        string $token,
        string $secret,
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        StreamFactory $streamFactory,
        UriFactory $uriFactory
    ) {
        $this->token = $token;
        $this->secret = $secret;
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->uriFactory = $uriFactory;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Creates request with necessary headers & encoded body.
     *
     * @param string $method
     * @param string $uri
     * @param array $body
     * @return RequestInterface
     */
    public function createRequest(string $method, string $uri, array $body = []): RequestInterface
    {
        $request = $this->requestFactory->createRequest(
            $method,
            $uri,
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . $this->token,
                'X-Secret' => $this->secret,
            ]
        );

        if (!empty($body)) {
            $request = $request->withBody($this->streamFactory->createStream(json_encode($body, JSON_UNESCAPED_UNICODE)));
        }

        return $request;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->httpClient->sendRequest($request);
    }
}
