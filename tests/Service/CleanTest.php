<?php

namespace Gietos\Dadata\Tests\Service;

use Gietos\Dadata\ApiRequestFactory;
use Gietos\Dadata\Model\Response\Clean\AddressCollection;
use Gietos\Dadata\Service\Clean as CleanService;
use Gietos\Dadata\Tests\BaseTestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Zend\Diactoros\ResponseFactory;
use Zend\Diactoros\StreamFactory;

class CleanTest extends BaseTestCase
{
    /** @var ResponseFactoryInterface */
    private $responseFactory;
    /** @var StreamFactoryInterface */
    private $streamFactory;

    public function setUp()
    {
        $this->responseFactory = new ResponseFactory();
        $this->streamFactory = new StreamFactory();
    }

    public function testCleanAddress()
    {
        /** @var ApiRequestFactory $apiRequestFactory */
        $apiRequestFactory = $this->getMockBuilder(ApiRequestFactory::class)->disableOriginalConstructor()->getMock();
        $response = $this->responseFactory->createResponse()
            ->withBody($this->streamFactory->createStream($this->loadFixture('clean-address-example.json')));
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('sendRequest')->willReturn($response);

        $service = new CleanService($apiRequestFactory, $httpClient);
        $addressCollection = $service->cleanAddress(['']);

        $this->assertInstanceOf(AddressCollection::class, $addressCollection);
    }
}
