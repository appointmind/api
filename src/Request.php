<?php
namespace Appointmind;

use Zend\Http\Client;

/**
 * 
 */
class Request
{
    /**
     * @var string
     */
    private $uri;
    
    /**
     * @var string
     */
    private $accessKey;
    
    /**
     * @var string
     */
    private $secretKey;
    
    /**
     * @var json
     */
    private $json;
    
    /** 
     * @var array
     */
    private $headers = [];
    
    /**
     * 
     */
    public function __construct()
    {
        
    }
    
    /**
     * Set URI
     * @param string $uri
     * @return \Appointmind\Request
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }
    
    /**
     * Set access key
     * @param string $key
     * @return \Appointmind\Request
     */
    public function setAccessKey($key)
    {
        $this->accessKey = $key;
        return $this;
    }
    
    /**
     * Set secret key
     * @param string $key
     * @return \Appointmind\Request
     */
    public function setSecretKey($key)
    {
        $this->secretKey = $key;
        return $this;
    }
    
    /**
     * Set json
     * @param json $json
     * @return \Appointmind\Request
     */
    public function setJson($json)
    {
        $this->json = $json;
        return $this;
    }
    
    /**
     * Set array
     * @param array $array
     * @return \Appointmind\Request
     */
    public function setArray($array)
    {
        $this->json = json_encode($array);
        return $this;
    }
    
    /**
     * Set object
     * @param object $object
     * @return \Appointmind\Request
     */
    public function setObject($object)
    {
        $this->json = json_encode($object);
        return $this;
    }
    
    public function setHeaders($headers)
    {
        $this->headers + $headers;
        return $this;
    }
 
    /**
     * Send request
     * @return \Appointmind\Response
     */
    public function send()
    {
        $client = new Client();
        $client->setUri($this->uri);
        $client->setMethod('POST');
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $client->setOptions($this->getOptions());
        $client->setRawBody($this->json);
        $client->setHeaders($this->headers);
        
        $response = $client->send();
        return new Response($response);
    }
    
    /**
     * Get options
     * @return array
     */
    private function getOptions()
    {
        $options = [];
        $caPathOrFile = \Composer\CaBundle\CaBundle::getSystemCaRootBundlePath();
        if (is_dir($caPathOrFile) || (is_link($caPathOrFile) && is_dir(readlink($caPathOrFile)))) {
            $options['capath'] = $caPathOrFile;
        } else {
            $options['cafile'] = $caPathOrFile;
        }
        return $options;
    }
}
