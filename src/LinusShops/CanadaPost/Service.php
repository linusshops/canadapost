<?php
namespace LinusShops\CanadaPost;

use LinusShops\CanadaPost\Exceptions\InvalidRequestException;

/**
 *
 *
 * @author Sam Schmidt <samuel@dersam.net>
 * @since 2015-12-09
 * @company Linus Shops
 */
abstract class Service
{
    protected $baseUrl;
    protected $parameters = array();

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
        return $this;
    }

    public function getParameter($name)
    {
        return isset($this->parameters[$name]) ?
            $this->parameters[$name] : null;
    }

    abstract public function send();

    public function parse(\DOMDocument $document)
    {

    }
}
