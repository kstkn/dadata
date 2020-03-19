<?php

namespace Gietos\Dadata\Tests\Service\Suggestions;

use Gietos\Dadata\ApiRequestFactory;
use Gietos\Dadata\Service\Suggestions\PostalUnit;
use Gietos\Dadata\Tests\BaseTestCase;
use Http\Client\Curl\Client;
use Zend\Diactoros\RequestFactory;
use Zend\Diactoros\StreamFactory;
use Zend\Diactoros\UriFactory;

/**
 * @coversDefaultClass \Gietos\Dadata\Service\Suggestions\PostalUnit
 *
 * @group api
 */
class PostalUnitTest extends BaseTestCase
{
    private static function createService()
    {
        $factory = new ApiRequestFactory($_SERVER['TOKEN'], $_SERVER['SECRET'], new RequestFactory(), new StreamFactory(), new UriFactory());
        return new PostalUnit($factory, new Client());
    }

    /**
     * @covers ::suggest
     */
    public function testSuggest(): void
    {
        $svc = self::createService();
        $result = $svc->suggest('дежнева 2а');
        self::assertArrayHasKey('suggestions', $result);
        self::assertCount(1, $result['suggestions']);

        $s = $result['suggestions'][0];
        self::assertSame('г Москва, проезд Дежнёва, д 2А', $s['unrestricted_value']);
    }

    /**
     * @covers ::findById
     */
    public function testFindById(): void
    {
        $svc = self::createService();
        $result = $svc->findById('127642');
        self::assertArrayHasKey('suggestions', $result);
        self::assertCount(1, $result['suggestions']);

        $s = $result['suggestions'][0];
        self::assertSame('г Москва, проезд Дежнёва, д 2А', $s['unrestricted_value']);
    }

    /**
     * @covers ::geolocate
     */
    public function testGeolocate(): void
    {
        $svc = self::createService();
        $result = $svc->geolocate(55.878, 37.653, 1000);
        self::assertNotEmpty($result);
    }
}
