<?php

namespace Gietos\Dadata\Service;

use Gietos\Dadata\AbstractService;
use Gietos\Dadata\Model\Response\Error;
use Gietos\Dadata\Model\Response\Suggestions\AddressSuggestionsCollection;
use Gietos\Dadata\Model\Response\Suggestions\AddressSuggestionsResponse;
use Gietos\Dadata\Model\Response\Suggestions\EmailSuggestionCollection;
use Gietos\Dadata\Model\Response\Suggestions\EmailSuggestionResponse;
use Gietos\Dadata\Model\Response\Suggestions\FioSuggestionsCollection;
use Gietos\Dadata\Model\Response\Suggestions\FioSuggestionsResponse;

class Suggestions extends AbstractService
{
    protected function getBaseUri(): string
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs';
    }

    public function detectAddressByIp()
    {
        // todo
    }

    public function findAddressById()
    {
        // todo
    }

    /**
     * @param string $query
     * @return FioSuggestionsCollection|Error
     */
    public function suggestFio(string $query)
    {
        $request = $this->apiClient->createRequest('POST', $this->getBaseUri() . '/suggest/fio', ['query' => $query]);
        $response = $this->apiClient->sendRequest($request);
        $result = $this->getResult($request, $response, FioSuggestionsResponse::class);
        if ($result instanceof FioSuggestionsResponse) {
            return $result->getSuggestions();
        }
        return $result;
    }

    /**
     * @param string $query
     * @param int $count
     * @return AddressSuggestionsCollection|Error
     */
    public function suggestAddress(string $query, int $count = 10)
    {
        $body = ['query' => $query, 'count' => $count];
        $request = $this->apiClient->createRequest('POST', $this->getBaseUri() . '/suggest/address', $body);
        $response = $this->apiClient->sendRequest($request);
        $result = $this->getResult($request, $response, AddressSuggestionsResponse::class);
        if ($result instanceof AddressSuggestionsResponse) {
            return $result->getSuggestions();
        }
        return $result;
    }

    public function suggestParty()
    {
        // todo
    }

    public function suggestBank()
    {
        // todo
    }

    /**
     * @param string $query
     * @return EmailSuggestionCollection|Error
     */
    public function suggestEmail(string $query)
    {
        $request = $this->apiClient->createRequest('POST', $this->getBaseUri() . '/suggest/email', ['query' => $query]);
        $response = $this->apiClient->sendRequest($request);
        $result = $this->getResult($request, $response, EmailSuggestionResponse::class);
        if ($result instanceof EmailSuggestionResponse) {
            return $result->getSuggestions();
        }
        return $result;
    }
}
