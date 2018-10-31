<?php

namespace Gietos\Dadata;

use Gietos\Dadata\Model\ConfigurableInterface;
use Gietos\Dadata\Model\Response\Error;
use Psr\Http\Message\ResponseInterface;

class JsonMediator
{
    /**
     * @param int $code
     * @param array $data
     * @return Error
     */
    protected function getError(int $code, array $data): Error
    {
        return new Error($code, $data['detail']);
    }

    /**
     * @param string $className
     * @param array $data
     * @return object
     */
    protected function getObject($className, array $data)
    {
        if (null === $className) {
            throw new \InvalidArgumentException('Expected string, got NULL');
        }

        $object = new $className;
        if (!$object instanceof ConfigurableInterface) {
            throw new \InvalidArgumentException(sprintf('Class %s must implement ConfigurableInterface', $className));
        }
        $object->configure($data);

        return $object;
    }

    /**
     * @param ResponseInterface $response
     * @param string $expectedResponseClass
     * @return object|Error
     */
    public function getResult(ResponseInterface $response, string $expectedResponseClass)
    {
        $data = json_decode((string) $response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(sprintf('Could not parse JSON response: %s', json_last_error_msg()));
        }

        if ($response->getStatusCode() !== 200) {
            return $this->getError($response->getStatusCode(), $data);
        }

        if (!is_array($data)) {
            throw new \Exception('Unexpected JSON response. Array is expected');
        }

        return $this->getObject($expectedResponseClass, $data);
    }
}
