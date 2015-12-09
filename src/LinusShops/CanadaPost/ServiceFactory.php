<?php
namespace LinusShops\CanadaPost;
/**
 *
 *
 * @author Sam Schmidt <samuel@dersam.net>
 * @since 2015-12-09
 * @company Linus Shops
 */

class ServiceFactory
{
    private $endpointUrl;

    public function __construct($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;
    }

    public function getService($name)
    {
        $classname = "\\LinusShops\\CanadaPost\\Services\{$name}";
        return new $classname();
    }
}
