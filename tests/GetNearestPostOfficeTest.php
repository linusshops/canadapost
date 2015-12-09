<?php

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
            "https://ct.soa-gw.canadapost.ca",
            CP_USER,
            CP_PASSWORD
        );

        $service = $factory->getService('GetNearestPostOffice');
        $this->assertInstanceOf(
            '\\LinusShops\\CanadaPost\\Services\\GetNearestPostOffice',
            $service
        );
        $this->assertInstanceOf('\LinusShops\CanadaPost\Service', $service);
    }

    public function testGetNearestPostOfficeLookupByPostalCode()
    {
        $factory = new \LinusShops\CanadaPost\ServiceFactory(
            "https://ct.soa-gw.canadapost.ca",
            CP_USER,
            CP_PASSWORD
        );

        /** @var \LinusShops\CanadaPost\Services\GetNearestPostOffice $service */
        $service = $factory->getService('GetNearestPostOffice');
        $response = $service
            ->setParameter('d2po', 'true')
            ->setParameter('postalCode', LOOKUP_CODE)
            ->send()
        ;
        print_r($response);
    }
}
