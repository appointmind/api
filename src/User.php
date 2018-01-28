<?php
namespace Appointmind;

/**
 * 
 */
class User extends Request
{
    public function create($data = [])
    {
        $frame = new \stdClass;
        $frame->jsonrpc = '2.0';
        $frame->id = "1";        
        $frame->method = 'createUser';
        $frame->params = new \stdClass;
        $frame->params->firstName = $data['firstName'];
        $frame->params->lastName = $data['lastName'];
        $frame->params->email = $userData['email'];
        $frame->params->password = $userData['password'];
        $frame->params->userData = [];
        

        $json = json_encode($frame);
        
        $signatureString = 'POST' . "\n" . md5($json) . "\n" . 'application/json' . "\n" . gmdate("Y-m-d H:i:s") . "\n";
        
        $headers = [
            'Date: ' . gmdate('D, d M Y H:i:s \G\M\T'),
            'Authorization: WOMS ' . $this->apiAccessKey . ':' . base64_encode(hash_hmac('sha256', $signatureString, $this->apiSecretKey)),
            'Content-Type: application/json'
        ];
        
        $this->setHeaders($headers);
        return $this->send();
    }
}
