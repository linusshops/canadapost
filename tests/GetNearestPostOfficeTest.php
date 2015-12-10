<?php
use GuzzleHttp\Exception\ClientException;

/**
 *
 *
 * @author Sam Schmidt <samuel@dersam.net>
 * @since 2015-12-09
 * @company Linus Shops
 */
class GetNearestPostOfficeTest extends PHPUnit_Framework_TestCase
{
    public function testLoadByFactory()
    {
        $factory = new \LinusShops\CanadaPost\ServiceFactory(
            CP_SANDBOX_ENDPOINT,
            CP_USER,
            CP_PASSWORD
        );

        $service = $factory->getService('GetNearestPostOffice');
        $this->assertInstanceOf(
            '\\LinusShops\\CanadaPost\\Services\\GetNearestPostOffice',
            $service
        );
        $this->assertInstanceOf('\\LinusShops\\CanadaPost\\Service', $service);
    }

    public function testGetNearestPostOfficeLookupByPostalCode()
    {
        $factory = new \LinusShops\CanadaPost\ServiceFactory(
            CP_SANDBOX_ENDPOINT,
            CP_USER,
            CP_PASSWORD
        );

        /** @var \LinusShops\CanadaPost\Services\GetNearestPostOffice $service */
        $service = $factory->getService('GetNearestPostOffice');

        $response = $service
            ->setParameter('d2po', 'true')
            ->setParameter('postalCode', LOOKUP_CODE)
            ->setParameter('city', LOOKUP_CITY)
            ->setParameter('province', LOOKUP_PROVINCE)
            ->send();

        $doc = new DOMDocument();
        $this->assertTrue($doc->loadXML($response->getBody()), "Response not valid XML");
    }

    public function testGetNearestPostOfficeLookupByLongLat()
    {
        $factory = new \LinusShops\CanadaPost\ServiceFactory(
            CP_SANDBOX_ENDPOINT,
            CP_USER,
            CP_PASSWORD
        );

        /** @var \LinusShops\CanadaPost\Services\GetNearestPostOffice $service */
        $service = $factory->getService('GetNearestPostOffice');
        $response = $service
            ->setParameter('d2po', 'true')
            ->setParameter('longitude', LOOKUP_LONG)
            ->setParameter('latitude', LOOKUP_LAT)
            ->send();

        $doc = new DOMDocument();
        $this->assertTrue($doc->loadXML($response->getBody()), "Response not valid XML");
    }

    public function testSetMaximumOffices()
    {
        $factory = new \LinusShops\CanadaPost\ServiceFactory(
            CP_SANDBOX_ENDPOINT,
            CP_USER,
            CP_PASSWORD
        );

        /** @var \LinusShops\CanadaPost\Services\GetNearestPostOffice $service */
        $service = $factory->getService('GetNearestPostOffice');
        $response = $service
            ->setParameter('d2po', 'true')
            ->setParameter('longitude', LOOKUP_LONG)
            ->setParameter('latitude', LOOKUP_LAT)
            ->setParameter('maximum', 5)
            ->send();

        $doc = new DOMDocument();
        $this->assertTrue($doc->loadXML($response->getBody()), "Response not valid XML");
        $children = $doc->firstChild->childNodes;
        $this->assertEquals(5, $children->length);
    }

    public function testSetLanguage()
    {
        $factory = new \LinusShops\CanadaPost\ServiceFactory(
            CP_SANDBOX_ENDPOINT,
            CP_USER,
            CP_PASSWORD
        );

        /** @var \LinusShops\CanadaPost\Services\GetNearestPostOffice $service */
        $service = $factory->getService('GetNearestPostOffice');
        $response = $service
            ->setLanguage('fr-CA')
            ->setParameter('d2po', 'true')
            ->setParameter('longitude', LOOKUP_LONG)
            ->setParameter('latitude', LOOKUP_LAT)
            ->send();

        $doc = new DOMDocument();
        $this->assertTrue($doc->loadXML($response->getBody()), "Response not valid XML");
        $children = $doc->firstChild->childNodes;
        $this->assertEquals(10, $children->length);
    }
}
