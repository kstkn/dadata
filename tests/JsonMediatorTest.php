<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\JsonMediator;
use Gietos\Dadata\Model\Response\Error;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Zend\Diactoros\RequestFactory;
use Zend\Diactoros\ResponseFactory;
use Zend\Diactoros\StreamFactory;

class JsonMediatorTest extends BaseTestCase
{
    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var ResponseFactoryInterface
     */
    protected $responseFactory;

    /**
     * @var JsonMediator
     */
    protected $jsonMediator;

    /**
     * @var StreamFactory
     */
    protected $streamFactory;

    public function setUp()
    {
        $this->requestFactory = new RequestFactory();
        $this->responseFactory = new ResponseFactory();
        $this->streamFactory = new StreamFactory();
        $this->jsonMediator = new JsonMediator();
    }

    public function testExceptionOnInvalidJsonSyntax()
    {
        $response = $this->responseFactory->createResponse();
        $this->expectException(\Exception::class);
        $this->jsonMediator->getResult($response, \stdClass::class);
    }

    public function testError()
    {
        $response = $this->responseFactory->createResponse(401)
            ->withBody($this->streamFactory->createStream('{"detail":"Some details"}'))
        ;
        $result = $this->jsonMediator->getResult($response, \stdClass::class);

        $this->assertInstanceOf(Error::class, $result);
    }
}
