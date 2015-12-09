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
    private $userid;
    private $password;

    public function __construct($baseUrl, $userid, $password)
    {
        $this->baseUrl = $baseUrl;
        $this->userid = $userid;
        $this->password = $password;
    }

    public function getService($name)
    {
        $classname = "\\LinusShops\\CanadaPost\\Services\\{$name}";
        return new $classname($this->baseUrl, $this->userid, $this->password);
    }
}
