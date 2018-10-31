<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\ApiRequestFactory;
use Zend\Diactoros\RequestFactory;
use Zend\Diactoros\StreamFactory;
use Zend\Diactoros\UriFactory;

class ApiRequestFactoryTest extends BaseTestCase
{
    /**
     * @var string
     */
    protected $token = 'token';

    /**
     * @var string
     */
    protected $secret = 'secret';

    /**
     * @var ApiRequestFactory
     */
    protected $apiRequestFactory;

    public function setUp()
    {
        $this->apiRequestFactory = new ApiRequestFactory(
            $this->token,
            $this->secret,
            new RequestFactory(),
            new StreamFactory(),
            new UriFactory()
        );
    }

    public function testRequestWithCorrectMethodCreated()
    {
        $method = 'GET';
        $request = $this->apiRequestFactory->createRequest($method, '');
        $this->assertEquals($method, $request->getMethod());
    }

    public function testRequestWithCorrectEndpointCreated()
    {
        $endpoint = 'https://example.com/endpoint';
        $request = $this->apiRequestFactory->createRequest('GET', $endpoint);
        $this->assertEquals($endpoint, (string) $request->getUri());
    }

    public function testRequestWithCorrectHeadersCreated()
    {
        $expectedHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Token ' . $this->token,
            'X-Secret' => $this->secret,
        ];

        $request = $this->apiRequestFactory->createRequest('POST', 'https://example.com/endpoint');

        foreach ($expectedHeaders as $name => $value) {
            $this->assertEquals($value, (string) $request->getHeaderLine($name));
        }
    }

    public function testRequestWithCorrectBodyCreated()
    {
        $body = ['one' => 1];
        $encodedBody = '{"one":1}';

        $request = $this->apiRequestFactory->createRequest('GET', 'https://example.com/endpoint', $body);

        $this->assertEquals($encodedBody, (string) $request->getBody());
    }
}
