<?php
namespace Appointmind;

use Zend\Http\Response as ZendResponse;

/**
 * 
 */
class Response
{
    /**
     * 
     * @var \Zend\Http\Response
     */
    private $response;
    
    public function __construct(ZendResponse $response)
    {
        $this->response = $response;
    }
    
    /**
     * Get JSON string
     * @return string
     */
    public function getJson()
    {
        return $this->response->getBody();
    }
    
    /**
     * Get array from json response
     * @return array
     */
    public function getArray()
    {
        return json_decode($this->response->getBody(), true);
    }
    
    /**
     * Get std object from json response
     * @return object
     */
    public function getObject()
    {
        return json_decode($this->response->getBody(), false);
    }
}
