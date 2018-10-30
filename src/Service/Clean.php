<?php

namespace Gietos\Dadata\Service;

use Gietos\Dadata\AbstractService;
use Gietos\Dadata\Model\Response\Clean\AddressCollection;
use Gietos\Dadata\Model\Response\Clean\NameCollection;
use Gietos\Dadata\Model\Response\Error;

class Clean extends AbstractService
{
    protected function getBaseUri(): string
    {
        return parent::getBaseUri() . '/clean';
    }

    /**
     * Cleans address.
     *
     * @param array $addresses
     * @return AddressCollection|Error
     * @internal param string $address
     */
    public function cleanAddress(array $addresses)
    {
        $request = $this->apiRequestFactory->createRequest('POST', $this->getBaseUri() . '/address', $addresses);
        $response = $this->httpClient->sendRequest($request);
        return $this->getResult($response, AddressCollection::class);
    }

    public function cleanPhone()
    {
        // todo
    }

    public function cleanPassport()
    {
        // todo
    }

    /**
     * Cleans name.
     *
     * @param array $names
     * @return NameCollection|Error
     */
    public function cleanName(array $names)
    {
        $request = $this->apiRequestFactory->createRequest('POST', $this->getBaseUri() . '/name', $names);
        $response = $this->httpClient->sendRequest($request);
        return $this->getResult($response, NameCollection::class);
    }

    public function cleanEmail()
    {
        // todo
    }

    public function cleanBirthDate()
    {
        // todo
    }

    public function cleanVehicle()
    {
        // todo
    }
}
