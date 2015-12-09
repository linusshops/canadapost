<?php
namespace LinusShops\CanadaPost\Services;
use Guzzle\Http\Client;
use LinusShops\CanadaPost\Service;
/**
 * Get the nearest post office
 *
 * @see https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/findpostoffice/nearestpostoffice.jsf
 * @author Sam Schmidt <samuel@dersam.net>
 * @since 2015-12-09
 * @company Linus Shops
 */

class GetNearestPostOffice extends Service
{
    private function getUri()
    {
        $uri = "/rs/postoffice?";
        $uri .= "d2po={$this->getParameter('d2po')}";
        $uri .= "&postalCode={$this->getParameter('postalCode')}";
        $uri .= "&province={$this->getParameter('province')}";
        $uri .= "&city={$this->getParameter('city')}";
        $uri .= "&streetName={$this->getParameter('streetName')}";
        $uri .= "&maximum={$this->getParameter('maximum', 10)}";

        return $uri;
    }

    /**
     * @return \Guzzle\Http\Message\RequestInterface
     */
    protected function buildRequest()
    {
        $client = new Client($this->getBaseUrl());
        $request = $client->get($this->getUri());
        $request
            ->addHeader('Accept', 'application/vnd.cpc.postoffice+xml ');
        return $request;
    }
}
