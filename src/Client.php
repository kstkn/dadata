<?php

namespace Dadata;

use Dadata\Response\Address;
use Dadata\Response\Name;
use Dadata\Response\Passport;
use Dadata\Response\Phone;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 */
class Client
{
    /**
     * Исходное значение распознано уверенно. Не требуется ручная проверка
     */
    const QC_OK = 0;
    /**
     * Исходное значение распознано с допущениями или не распознано. Требуется ручная проверка
     */
    const QC_UNSURE = 1;
    /**
     * Исходное значение пустое или заведомо "мусорное"
     */
    const QC_INVALID = 2;
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

    public function __construct(HttpClient $httpClient, array $config = [])
    {
        $this->httpClient = $httpClient;
        foreach ($config as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     * Cleans address.
     *
     * @param string $address
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
     * @param string $phone
     * @return Phone
     */
    public function cleanPhone($phone)
    {
        $response = $this->query($this->prepareUri('clean/phone'), $phone);
        return $this->populate(new Phone(), $response);
    }

    /**
     * Cleans passport.
     *
     * @param string $passport
     * @return Passport
     */
    public function cleanPassport($passport)
    {
        $response = $this->query($this->prepareUri('clean/passport'), $passport);
        return $this->populate(new Passport(), $response);
    }

    /**
     * Cleans name.
     *
     * @param string $name
     * @return Name
     */
    public function cleanName($name)
    {
        $response = $this->query($this->prepareUri('clean/name'), $name);
        return $this->populate(new Name(), $response);
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
