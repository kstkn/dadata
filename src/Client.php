<?php

namespace Dadata;

use Dadata\Response\AbstractResponse;
use Dadata\Response\Address;
use Dadata\Response\Date;
use Dadata\Response\Email;
use Dadata\Response\Name;
use Dadata\Response\Passport;
use Dadata\Response\Phone;
use Dadata\Response\Suggestions\Party;
use Dadata\Response\Vehicle;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

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
     * Suggestions url
     * @var string
     */
    protected $baseSuggestionsUrl = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $httpOptions = [];

    public function __construct(ClientInterface $httpClient, array $config = [])
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
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanAddress($address)
    {
        $response = $this->query($this->prepareUri('clean/address'), [$address]);
        /** @var Address $result */
        $result = $this->populate(new Address, $response);

        return $result;
    }

    /**
     * Cleans phone.
     *
     * @param string $phone
     *
     * @return Phone
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanPhone($phone)
    {
        $response = $this->query($this->prepareUri('clean/phone'), [$phone]);
        /** @var Phone $result */
        $result = $this->populate(new Phone(), $response);

        return $result;
    }

    /**
     * Cleans passport.
     *
     * @param string $passport
     *
     * @return Passport
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanPassport($passport)
    {
        $response = $this->query($this->prepareUri('clean/passport'), [$passport]);
        /** @var Passport $result */
        $result = $this->populate(new Passport(), $response);

        return $result;
    }

    /**
     * Cleans name.
     *
     * @param string $name
     *
     * @return Name
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanName($name)
    {
        $response = $this->query($this->prepareUri('clean/name'), [$name]);
        /** @var Name $result */
        $result = $this->populate(new Name(), $response);

        return $result;
    }

    /**
     * Cleans email.
     *
     * @param string $email
     *
     * @return Email
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanEmail($email)
    {
        $response = $this->query($this->prepareUri('clean/email'), [$email]);
        /** @var Email $result */
        $result = $this->populate(new Email(), $response);

        return $result;
    }

    /**
     * Cleans date.
     *
     * @param string $date
     *
     * @return Date
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanDate($date)
    {
        $response = $this->query($this->prepareUri('clean/birthdate'), [$date]);
        /** @var Date $result */
        $result = $this->populate(new Date(), $response);

        return $result;
    }

    /**
     * Cleans vehicle.
     *
     * @param string $vehicle
     *
     * @return Vehicle
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function cleanVehicle($vehicle)
    {
        $response = $this->query($this->prepareUri('clean/vehicle'), [$vehicle]);
        /** @var Vehicle $result */
        $result = $this->populate(new Vehicle(), $response);

        return $result;
    }

    /**
     * Gets balance.
     *
     * @return float
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function getBalance()
    {
        $response = $this->query($this->prepareUri('profile/balance'), [], self::METHOD_GET);
        return (float) $response;
    }

    /**
     * Requests API.
     *
     * @param string $uri
     * @param array $params
     *
     * @param string $method
     *
     * @return array
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    protected function query($uri, array $params = [], $method = self::METHOD_POST)
    {
        $request = new Request($method, $uri, [
            'Content-Type' => 'application/json',
            'Authorization' => 'Token ' . $this->token,
            'X-Secret' => $this->secret,
        ], 0 < count($params) ? json_encode($params) : null);

        $response = $this->httpClient->send($request, $this->httpOptions);

        $result = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Error parsing response: ' . json_last_error_msg());
        }

        if (empty($result)) {
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
     * @param array            $data
     *
     * @return AbstractResponse
     * @throws \ReflectionException
     */
    protected function populate(AbstractResponse $object, array $data)
    {
        $reflect = new \ReflectionClass($object);

        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            if (array_key_exists($property->name, $data)) {
                $object->{$property->name} = $this->getValueByAnnotatedType($property, $data[$property->name]);
            }
        }

        return $object;
    }

    /**
     * Создаем объект ответа по подсказкам организации
     *
     * @param array $response
     *
     * @return Party\Party
     * @throws \ReflectionException
     */
    protected function populateParty(array $response)
    {
        $management = null;
        $managementData = $response['data']['management'];
        if (is_array($managementData) && array_key_exists('name', $managementData) && array_key_exists('post', $managementData)) {
            list($name, $post) = array_values($response['data']['management']);
            $management = new Party\ManagementDto($name, $post);
        }

        list($code, $full, $short) = array_values($response['data']['opf']);
        $opf = new Party\OpfDto($code, $full, $short);

        list($fullWithOpf, $shortWithOpf, $latin, $full, $short) = array_values($response['data']['name']);
        $name = new Party\NameDto($fullWithOpf, $shortWithOpf, $latin, $full, $short);

        list($status, $actualityDate, $registrationDate, $liquidationDate) = array_values($response['data']['state']);
        $state = new Party\StateDto($status, $actualityDate, $registrationDate, $liquidationDate);

        list($value, $unrestrictedValue) = array_values($response['data']['address']);
        $simpleAddress = new Party\AddressDto($value, $unrestrictedValue);

        $address = null;
        if (is_array($response['data']['address']['data'])) {
            $address = $this->populate(new Address(), $response['data']['address']['data']);
        }

        return new Party\Party(
            $response['value'],
            $response['unrestricted_value'],
            $response['data']['kpp'],
            $management,
            $response['data']['branch_type'],
            $response['data']['type'],
            $opf,
            $name,
            $response['data']['inn'],
            $response['data']['ogrn'],
            $response['data']['okpo'],
            $response['data']['okved'],
            $state,
            $simpleAddress,
            $address
        );
    }

    /**
     * Guesses and converts property type by phpdoc comment.
     *
     * @param \ReflectionProperty $property
     * @param  mixed $value
     * @return mixed
     */
    protected function getValueByAnnotatedType(\ReflectionProperty $property, $value)
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

    /**
     * @param string $ip
     * @return null|Address
     * @throws \Exception
     * @throws GuzzleException
     */
    public function detectAddressByIp($ip)
    {
        $request = new Request('get', $this->baseSuggestionsUrl . 'detectAddressByIp' . '?ip=' . $ip, [
            'Accept' => 'application/json',
            'Authorization' => 'Token ' . $this->token,
        ]);

        $response = $this->httpClient->send($request);

        $result = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Error parsing response: ' . json_last_error_msg());
        }

        if (!array_key_exists('location', $result)) {
            throw new \Exception('Required key "location" is missing');
        }

        if (null === $result['location']) {
            return null;
        }

        if (!array_key_exists('data', $result['location'])) {
            throw new \Exception('Required key "data" is missing');
        }

        if (null === $result['location']['data']) {
            return null;
        }

        /** @var Address $address */
        $address = $this->populate(new Address, $result['location']['data']);

        return $address;
    }

    /**
     * Метод возвращает арес по его коду КЛАДР или ФИАС
     *
     * Dadata comment: Ищет до улицы включительно, при поиске по коду дома возвращает пустой ответ.
     * Так сделано намеренно: КЛАДР-коды и ФИАС-коды домов постоянно изменяются, поэтому хранить их ненадежно.
     * Рекомендуем использовать связку «ФИАС-код улицы + домовая часть отдельно»
     *
     * @param string $addressId
     *
     * @return AbstractResponse|Address|null
     * @throws \ReflectionException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws GuzzleException
     */
    public function getAddressById($addressId)
    {
        $response = $this->query($this->baseSuggestionsUrl . 'findById/address', ['query' => $addressId]);

        if (is_array($response) && 0 < count($response)) {
            /** @var Address $address */
            $address = $this->populate(new Address, array_shift($response)['data']);

            return $address;
        }

        return null;
    }

    /**
     * Ищет организации и индивидуальных предпринимателей:
     * по ИНН / ОГРН;
     * названию (полному, краткому, латинскому);
     * ФИО (для индивидуальных предпринимателей);
     * ФИО руководителя компании;
     * адресу до улицы.
     *
     * @param string $party
     *
     * @return \SplObjectStorage
     * @throws GuzzleException
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function suggestParties($party)
    {
        $response = $this->query($this->prepareSuggestionsUri('suggest/party'), ['query' => $party]);
        $collection = new \SplObjectStorage();

        foreach ($response as $arParty) {
            $party = $this->populateParty($arParty);
            $collection->attach($party);
        }
        return $collection;
    }

    /**
     * Prepares suggest URI for the request.
     *
     * @param string $endpoint
     *
     * @return string
     */
    protected function prepareSuggestionsUri($endpoint)
    {
        return $this->baseSuggestionsUrl . $endpoint;
    }
}
