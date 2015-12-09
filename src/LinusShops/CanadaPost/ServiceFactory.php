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
    private $baseUrl;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getService($name)
    {
        $classname = "\\LinusShops\\CanadaPost\\Services\\{$name}";
        return new $classname($this->baseUrl);
    }
}
