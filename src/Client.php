<?php

namespace Dadata;

use Dadata\Response\AbstractResponse;
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
    
    const METHOD_GET = 'GET';
    
    const METHOD_POST = 'POST';
    
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
     *
     * @return Address
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function cleanAddress($address)
    {
        $response = $this->query($this->prepareUri('clean/address'), [$address]);
        return $this->populate(new Address(), $response);
    }

    /**
     * Cleans phone.
     *
     * @param string $phone
     *
     * @return Phone
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function cleanPhone($phone)
    {
        $response = $this->query($this->prepareUri('clean/phone'), [$phone]);
        return $this->populate(new Phone(), $response);
    }

    /**
     * Cleans passport.
     *
     * @param string $passport
     *
     * @return Passport
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function cleanPassport($passport)
    {
        $response = $this->query($this->prepareUri('clean/passport'), [$passport]);
        return $this->populate(new Passport(), $response);
    }

    /**
     * Cleans name.
     *
     * @param string $name
     *
     * @return Name
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function cleanName($name)
    {
        $response = $this->query($this->prepareUri('clean/name'), [$name]);
        return $this->populate(new Name(), $response);
    }

    /**
     * Gets balance.
     *
     * @return float
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function getBalance()
    {
        $response = $this->query($this->prepareUri('profile/balance'), [], self::METHOD_GET);
        return (double) $response;
    }

    /**
     * Requests API.
     *
     * @param string $uri
     * @param array  $params
     *
     * @param string $method
     *
     * @return array
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    protected function query($uri, array $params = [], $method = self::METHOD_POST)
    {
        $request = new Request($method, $uri, [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Token ' . $this->token,
            'X-Secret'      => $this->secret,
        ], 0 < count($params) ? json_encode($params) : null);

        $response = $this->httpClient->send($request);

        $result = json_decode($response->getBody(), true);

        if (null === $result || !is_array($result)) {
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
     * @param AbstractResponse $object
     * @param array $data
     * @return AbstractResponse
     */
    protected function populate(AbstractResponse $object, array $data)
    {
        $reflect = new \ReflectionClass($object);

        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            if (array_key_exists($property->name, $data)) {
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
                case 'int':
                    $value = (int) $value;
                    break;
                case 'float':
                    $value = (float) $value;
                    break;
            }
        }

        return $value;
    }
}
