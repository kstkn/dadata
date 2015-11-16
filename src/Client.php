<?php

namespace Dadata;

use Dadata\Response\Address;
use Dadata\Response\Phone;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 */
class Client
{
    /**
     * @var string
     */
    protected $version = 'v2';
    /**
     * @var string
     */
    protected $baseUrl = 'https://dadata.ru/api';
    /**
     * @var string
     */
    protected $token;
    /**
     * @var string
     */
    protected $secret;
    /**
     * @var HttpClient
     */
    protected $httpClient;

    public function __construct(HttpClient $httpClient, array $params)
    {
        $this->httpClient = $httpClient;
        if (isset($params['token'])) {
            $this->token = $params['token'];
        }
        if (isset($params['secret'])) {
            $this->secret = $params['secret'];
        }
        if (!empty($cache)) {
            $this->cache = $cache;
        }
    }

    /**
     * Cleans address.
     *
     * @param $address
     * @return Address
     */
    public function cleanAddress($address)
    {
        $response = $this->query($this->prepareUri('clean/address'), $address);
        return $this->populate(new Address(), $response);
    }

    /**
     * Cleans phone.
     *
     * @param $phone
     * @return Phone
     */
    public function cleanPhone($phone)
    {
        $response = $this->query($this->prepareUri('clean/phone'), $phone);
        return $this->populate(new Phone(), $response);
    }

    /**
     * Requests API.
     *
     * @param string $uri
     * @param mixed  $params
     * @return array
     */
    protected function query($uri, $params)
    {
        $request = new Request('POST', $uri, [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Token ' . $this->token,
            'X-Secret'      => $this->secret,
        ], json_encode([$params]));

        $response = $this->httpClient->send($request);

        $result = json_decode($response->getBody(), true);

        if (empty($result) || !is_array($result)) {
            throw new \RuntimeException('Empty result');
        }

        return array_shift($result);
    }

    /**
     * Prepares URI for the request.
     *
     * @param string $endpoint
     * @return string
     */
    protected function prepareUri($endpoint)
    {
        return $this->baseUrl . '/' . $this->version . '/' . $endpoint;
    }

    /**
     * Populates object with data.
     *
     * @param object $object
     * @param array  $data
     * @return object
     */
    protected function populate($object, array $data)
    {
        $reflect = new \ReflectionClass($object);

        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            if (isset($data[$property->name])) {
                $object->{$property->name} = $this->getValueWithCorrectType($property, $data[$property->name]);
            }
        }

        return $object;
    }

    /**
     * Guesses and converts property type by phpdoc comment.
     *
     * @param \ReflectionProperty $property
     * @param  mixed $value
     * @return mixed
     */
    protected function getValueWithCorrectType(\ReflectionProperty $property, $value)
    {
        $comment = $property->getDocComment();
        if (preg_match('/@var (.+?)(\|null)? /', $comment, $matches)) {
            switch ($matches[1]) {
                case 'integer':
                    $value = (int)$value;
                    break;
                case 'float':
                    $value = (float)$value;
                    break;
            }
        }

        return $value;
    }
}
