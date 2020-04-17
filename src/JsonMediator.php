<?php

namespace Gietos\Dadata;

use Gietos\Dadata\Model\AbstractCollection;
use Gietos\Dadata\Model\Factory\MainFactory;
use Gietos\Dadata\Model\Response\Error;
use Psr\Http\Message\ResponseInterface;

class JsonMediator
{
    /** @var MainFactory */
    private $factory;

    public function __construct(MainFactory $factory)
    {
        $this->factory = $factory;
    }

    protected function getError(int $code, \stdClass $data): Error
    {
        return new Error($code, property_exists($data, 'details') ? $data->detail : '');
    }

    /**
     *
     * @param string $className
     * @param mixed $data
     * @return object
     */
    protected function getObject(string $className, $data)
    {
        $reflection = new \ReflectionClass($className);
        if ($reflection->isSubclassOf(AbstractCollection::class)) {
            return $this->factory->createCollection($reflection, $data);
        }

        return $this->factory->createObject($reflection, $data);
    }

    /**
     * @param ResponseInterface $response
     * @param string $expectedResponseClassName
     * @return object|Error
     */
    public function getResult(ResponseInterface $response, string $expectedResponseClassName)
    {
        $data = json_decode((string) $response->getBody());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(sprintf('Could not parse JSON response: %s', json_last_error_msg()));
        }

        if ($response->getStatusCode() !== 200) {
            return $this->getError($response->getStatusCode(), $data);
        }

        return $this->getObject($expectedResponseClassName, $data);
    }
}
