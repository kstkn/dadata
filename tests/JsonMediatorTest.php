<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\JsonMediator;
use Gietos\Dadata\Model\Response\Error;
use Http\Message\MessageFactory;
use Http\Message\MessageFactory\DiactorosMessageFactory;

class JsonMediatorTest extends BaseTestCase
{
    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var JsonMediator
     */
    protected $jsonMediator;

    public function setUp()
    {
        $this->messageFactory = new DiactorosMessageFactory;
        $this->jsonMediator = new JsonMediator;
    }

    public function testError()
    {
        $request = $this->messageFactory->createRequest('POST', '/');
        $response = $this->messageFactory->createResponse(401, null, [], '{"detail":"Some details"}');
        $result = $this->jsonMediator->getResult($request, $response, \stdClass::class);

        $this->assertInstanceOf(Error::class, $result);
    }
}
