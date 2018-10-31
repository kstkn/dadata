<?php

namespace Gietos\Dadata;

use Psr\Http\Message\{
    RequestFactoryInterface,
    RequestInterface,
    StreamFactoryInterface,
    UriFactoryInterface
};

class ApiRequestFactory
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
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @var UriFactoryInterface
     */
    private $uriFactory;

    public function __construct(
        string $token,
        string $secret,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        UriFactoryInterface $uriFactory
    ) {
        $this->token = $token;
        $this->secret = $secret;
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
     *
     * @return RequestInterface
     */
    public function createRequest(string $method, string $uri, array $body = []): RequestInterface
    {
        $request = $this->requestFactory->createRequest($method, $uri)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Authorization', 'Token ' . $this->token)
            ->withHeader('X-Secret', $this->secret)
        ;

        if (!empty($body)) {
            $request = $request
                ->withBody($this->streamFactory->createStream(json_encode($body, JSON_UNESCAPED_UNICODE)))
            ;
        }

        return $request;
    }
}
