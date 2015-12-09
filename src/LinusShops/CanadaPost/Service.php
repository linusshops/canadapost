<?php
namespace LinusShops\CanadaPost;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;


/**
 *
 *
 * @author Sam Schmidt <samuel@dersam.net>
 * @since 2015-12-09
 * @company Linus Shops
 */
abstract class Service
{
    const HTTP_GET = 'GET';
    const HTTP_POST = 'POST';
    const HTTP_PUT = 'PUT';
    const HTTP_DELETE = 'DELETE';
    const HTTP_PATCH = 'PATCH';

    protected $baseUrl;
    protected $userid;
    protected $password;
    protected $parameters = array();
    protected $headers = array(
        'Accept-language'=> 'en-CA'
    );

    public function __construct($baseUrl, $userid, $password)
    {
        $this->baseUrl = $baseUrl;
        $this->userid = $userid;
        $this->password = $password;
    }

    public function setLanguage($value)
    {
        $this->setHeader('Accept-language', $value);
    }

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function hasParameter($name)
    {
        return isset($this->parameters[$name]);
    }

    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
        return $this;
    }

    public function getParameter($name, $default=null)
    {
        return $this->hasParameter($name) ?
            $this->parameters[$name] : $default;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return Request
     */
    abstract protected function buildRequest();

    /**
     * @return Response
     */
    public function send()
    {
        $request = $this->buildRequest();

        //Apply standard headers
        $this->setHeader('Authorization', 'Basic '.base64_encode(
            $this->userid.':'.$this->password
        ));

        $client = new Client(array(
            'base_uri' => $this->getBaseUrl()
        ));

        return $client->send($request, array(
            'headers' => $this->headers
        ));
    }
}
