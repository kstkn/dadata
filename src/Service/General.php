<?php

namespace Gietos\Dadata\Service;

use Gietos\Dadata\AbstractService;
use Gietos\Dadata\Model\Response\Balance;
use Gietos\Dadata\Model\Response\Error;
use Gietos\Dadata\Model\Response\Version\Version;

class General extends AbstractService
{
    /**
     * Gets directories versions.
     *
     * @return Version|Error
     */
    public function getVersion()
    {
        $request = $this->apiClient->createRequest('GET', $this->getBaseUri() . '/version');
        $response = $this->apiClient->sendRequest($request);

        return $this->getResult($request, $response, Version::class);
    }

    /**
     * Gets clean service status.
     * If service is OK returns true, otherwise - false.
     *
     * @return bool|Error
     */
    public function getStatus()
    {
        $request = $this->apiClient->createRequest('GET', $this->getBaseUri() . '/status/CLEAN');
        $response = $this->apiClient->sendRequest($request);

        return $response->getStatusCode() === 200;
    }

    /**
     * Gets balance.
     *
     * @return float|Error
     */
    public function getBalance()
    {
        $request = $this->apiClient->createRequest('GET', $this->getBaseUri() . '/profile/balance');
        $response = $this->apiClient->sendRequest($request);

        $result = $this->getResult($request, $response, Balance::class);

        if ($result instanceof Balance) {
            return $result->getBalance();
        }

        return $result;
    }
}
