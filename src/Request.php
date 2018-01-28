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
     * Get access key
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
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
     * Get secret key
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }
    
    /**
     * Set JSON
     * @param json $json
     * @return \Appointmind\Request
     */
    public function setJson($json)
    {
        $this->json = $json;
        return $this;
    }
    
    /**
     * Get JSON
     * @return \Appointmind\json
     */
    public function getJson()
    {
        return $this->json;
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
    
    /**
     * Set headers
     * @param unknown $headers
     * @return \Appointmind\Request
     */
    public function setHeaders($headers)
    {
        $headers = (array) $headers;        
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }
    
    /**
     * Get headers
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    
    /**
     * Get Authorization headers
     * @throws \Exception
     * @return array
     */
    protected function getAuthorizationHeaders()
    {
        if (!$this->getAccessKey()) {
            throw new \Exception('Missing access key');
        }
        
        if (!$this->getSecretKey()) {
            throw new \Exception('Missing secret key');
        }        

        $signatureString = 'POST' . "\n" . hash('sha256', $this->json) . "\n" . 'application/json' . "\n" . gmdate("Y-m-d H:i:s") . "\n";
        
        return [
            'Date: ' . gmdate('D, d M Y H:i:s \G\M\T'),
            'Authorization: WOMS ' . $this->getAccessKey() . ':' . base64_encode(hash_hmac('sha256', $signatureString, $this->getSecretKey())),
            'Content-Type: application/json'
        ];
    }
 
    /**
     * Send request
     * @return \Appointmind\Response
     */
    public function send()
    {        
        $this->setHeaders($this->getAuthorizationHeaders());
        
        $client = new Client();
        $client->setUri($this->uri);
        $client->setMethod('POST');
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $client->setOptions($this->getOptions());
        $client->setRawBody($this->json);
        $client->setHeaders($this->getHeaders());
        $response = $client->send();
        return new Response($response);
    }
    
    /**
     * Get options
     * @return array
     */
    public function getOptions()
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
