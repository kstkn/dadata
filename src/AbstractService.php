<?php

namespace Gietos\Dadata;

use Gietos\Dadata\Model\Response\Error;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractService
{
    /**
     * @var Api
     */
    protected $apiClient;

    public function __construct(Api $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    protected function getBaseUri(): string
    {
        return 'https://dadata.ru/api/v2';
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $expectedResponseClass
     * @return object|Error
     */
    public function getResult(RequestInterface $request, ResponseInterface $response, $expectedResponseClass)
    {
        $responseMediator = new JsonMediator;
        $result = $responseMediator->getResult($request, $response, $expectedResponseClass);

        return $result;
    }
}
