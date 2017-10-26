<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Api;
use Gietos\Dadata\Model\Response\Suggestions\Email;
use Gietos\Dadata\Model\Response\Suggestions\EmailSuggestion;
use Gietos\Dadata\Model\Response\Suggestions\EmailSuggestionCollection;
use Gietos\Dadata\Service\Suggestions;
use GuzzleHttp\Psr7\Response;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Http\Message\StreamFactory\DiactorosStreamFactory;
use Http\Message\UriFactory\DiactorosUriFactory;
use Http\Mock\Client;

class SuggestionsTest extends BaseTestCase
{
    /**
     * @var Suggestions
     */
    private $suggestionsService;

    /**
     * @var Client
     */
    private $httpClient;

    public function setUp()
    {
        $this->httpClient = new Client;
        $apiClient = new Api(
            'token',
            '',
            $this->httpClient,
            new DiactorosMessageFactory,
            new DiactorosStreamFactory,
            new DiactorosUriFactory
        );
        $this->suggestionsService = new Suggestions($apiClient);
    }

    public function testSuggestEmail()
    {
        $this->httpClient->addResponse(new Response(200, [], $this->loadDataFile('suggest-email.json')));
        $result = $this->suggestionsService->suggestEmail('anton@');
        $this->assertInstanceOf(EmailSuggestionCollection::class, $result);
        /** @var EmailSuggestion $suggestion */
        $suggestion = $result->current();
        $this->assertInstanceOf(EmailSuggestion::class, $suggestion);
        $this->assertSame('anton@mail.ru', $suggestion->getValue());
        $this->assertSame('anton@mail.ru', $suggestion->getUnrestrictedValue());
        $data = $suggestion->getData();
        $this->assertInstanceOf(Email::class, $data);
        $this->assertSame('anton', $data->getLocal());
        $this->assertSame('mail.ru', $data->getDomain());
    }
}
