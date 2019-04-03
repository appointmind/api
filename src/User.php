<?php
namespace Appointmind;

/**
 * 
 */
class User extends Request
{
    /**
     * Create user
     * @param array $data
     * @return \Appointmind\Response
     */
    public function create($data = [])
    {
        $frame = new \stdClass;
        $frame->jsonrpc = '2.0';
        $frame->id = "1";        
        $frame->method = 'createUser';
        $frame->params = new \stdClass;

        if (isset($data['firstName'])) {
            $frame->params->firstName = $data['firstName'];
        }
        
        if (isset($data['lastName'])) {
            $frame->params->lastName = $data['lastName'];
        }
        
        if (isset($data['email'])) {
            $frame->params->email = $data['email'];
        }
        
        if (isset($data['password'])) {
            $frame->params->password = $data['password'];
        }
        
        if (
            isset($data['userData'])
            and is_array($data['userData'])
        ) {
            $frame->params->userData = $data['userData'];
        }
        
        $this->setObject($frame);
        return $this->send();
    }
    
    /**
     * Login user
     * @param array $data
     * @return \Appointmind\Response
     */
    public function login($email, $redirect = null)
    {
        $frame = new \stdClass;
        $frame->jsonrpc = '2.0';
        $frame->id = "1";        
        $frame->method = 'loginToken';
        $frame->params = new \stdClass;
        $frame->params->email = $email;
        
        if (!empty($redirect)) {
            $frame->params->redirect = $redirect;
        }
        
        $this->setObject($frame);
        return $this->send();
    }
}
