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

    abstract public function verb();

    /**
     * @return \DOMDocument
     */
    abstract public function buildXml();

    public function doRequest()
    {
        $document = $this->buildXml();
        $valid = $this->validateByXsd($document);

        if (!$valid) {
            $errstr = '';
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                $errstr .= $error->message.'\n';
            }
            throw new InvalidRequestException('Request document failed validation: '.$errstr);
        }
    }

    public function validateByXsd(\DOMDocument $document) {
        libxml_use_internal_errors(true);
        $className = get_class($this);
        $path = __DIR__.'../../../resources/xsd/'.$className.'.xsd';

        return $document->schemaValidate($path);
    }
}
