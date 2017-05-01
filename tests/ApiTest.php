<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Api;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Http\Message\StreamFactory\DiactorosStreamFactory;
use Http\Message\UriFactory\DiactorosUriFactory;
use Http\Mock\Client;

class ApiTest extends BaseTestCase
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
     * @var Api
     */
    protected $apiClient;

    public function setUp()
    {
        $this->apiClient = new Api(
            $this->token,
            $this->secret,
            new Client,
            new DiactorosMessageFactory,
            new DiactorosStreamFactory,
            new DiactorosUriFactory
        );
    }

    public function testRequestWithCorrectMethodCreated()
    {
        $method = 'GET';
        $request = $this->apiClient->createRequest($method, '');
        $this->assertEquals($method, $request->getMethod());
    }

    public function testRequestWithCorrectEndpointCreated()
    {
        $endpoint = 'https://example.com/endpoint';
        $request = $this->apiClient->createRequest('GET', $endpoint);
        $this->assertEquals($endpoint, (string) $request->getUri());
    }

    public function testRequestWithCorrectHeadersCreated()
    {
        $expectedHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Token ' . $this->token,
            'X-Secret' => $this->secret,
        ];

        $request = $this->apiClient->createRequest('POST', 'https://example.com/endpoint');

        foreach ($expectedHeaders as $name => $value) {
            $this->assertEquals($value, (string) $request->getHeaderLine($name));
        }
    }

    public function testRequestWithCorrectBodyCreated()
    {
        $body = ['one' => 1];
        $encodedBody = '{"one":1}';

        $request = $this->apiClient->createRequest('GET', 'https://example.com/endpoint', $body);

        $this->assertEquals($encodedBody, (string) $request->getBody());
    }
}
