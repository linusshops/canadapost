<?php
namespace LinusShops\CanadaPost;
/**
 *
 *
 * @author Sam Schmidt <samuel@dersam.net>
 * @since 2015-12-09
 * @company Linus Shops
 */
abstract class Service
{
    protected $endpointUrl;
    protected $parameters = array();

    public function __construct($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;
    }

    public function parameter($name, $value)
    {
        $this->parameters[$name] = $value;
        return $this;
    }

    abstract public function doRequest();
}
