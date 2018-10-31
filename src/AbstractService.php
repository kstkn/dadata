<?php

namespace Gietos\Dadata;

use Gietos\Dadata\Model\Response\Error;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractService
{
    /**
     * @var ApiRequestFactory
     */
    protected $apiRequestFactory;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    public function __construct(ApiRequestFactory $apiRequestFactory, ClientInterface $httpClient)
    {
        $this->apiRequestFactory = $apiRequestFactory;
        $this->httpClient = $httpClient;
    }

    protected function getBaseUri(): string
    {
        return 'https://dadata.ru/api/v2';
    }

    /**
     * @param ResponseInterface $response
     * @param string $expectedResponseClass
     * @return object|Error
     */
    public function getResult(ResponseInterface $response, $expectedResponseClass)
    {
        $responseMediator = new JsonMediator;
        $result = $responseMediator->getResult($response, $expectedResponseClass);

        return $result;
    }
}
