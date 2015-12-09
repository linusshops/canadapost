<?php
namespace LinusShops\CanadaPost\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
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
        if ($this->hasParameter('d2po')) {
            $uri .= "d2po={$this->getParameter('d2po')}&";
        }

        if ($this->hasParameter('tonight')) {
            $uri .= "tonight={$this->getParameter('tonight')}&";
        }

        $uri .= "maximum={$this->getParameter('maximum', 10)}&";

        if ($this->hasParameter('longitude') && $this->hasParameter('latitude')) {
            $uri .= "longitude={$this->getParameter('longitude')}&";
            $uri .= "latitude={$this->getParameter('latitude')}&";
        } else {
            $uri .= "postalCode={$this->getParameter('postalCode')}&";
            $uri .= "province={$this->getParameter('province')}&";
            $uri .= "city={$this->getParameter('city')}&";
            $uri .= "streetName={$this->getParameter('streetName')}&";
        }

        return $uri;
    }

    /**
     * @return Request
     */
    protected function buildRequest()
    {
        $request = new Request('GET', $this->getUri());
        $this->setHeader('Accept', 'application/vnd.cpc.postoffice+xml ');
        return $request;
    }
}
