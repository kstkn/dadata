<?php

namespace Gietos\Dadata\Service\Suggestions;

use Gietos\Dadata\AbstractService;

class PostalUnit extends AbstractService
{
    protected function getBaseUri(): string
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs';
    }

    public function suggest(string $query)
    {
        $body = ['query' => $query];
        $request = $this->apiRequestFactory->createRequest('POST', $this->getBaseUri() . '/suggest/postal_unit', $body);
        $response = $this->httpClient->sendRequest($request);
        return json_decode((string) $response->getBody(), true);
    }

    public function findById(string $query)
    {
        $body = ['query' => $query];
        $request = $this->apiRequestFactory->createRequest('POST', $this->getBaseUri() . '/findById/postal_unit', $body);
        $response = $this->httpClient->sendRequest($request);
        return json_decode((string) $response->getBody(), true);
    }

    public function geolocate(float $latitude, float $longitude, int $radiusMeters = 1000)
    {
        $body = ['lat' => $latitude, 'lot' => $longitude, 'radius_meters' => $radiusMeters];
        $request = $this->apiRequestFactory->createRequest('POST', $this->getBaseUri() . '/geolocate/postal_unit', $body);
        $response = $this->httpClient->sendRequest($request);
        return json_decode((string) $response->getBody(), true);
    }
}