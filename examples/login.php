<?php
require_once '../../../autoload.php';

$uri = '';
$accessKey = '';
$secretKey = '';
$email = 'abby.normal@example.com';
$redirect = 'https://www.example.com/';

$user = new \Appointmind\User();
$user->setUri($uri);
$user->setAccessKey($accessKey);
$user->setSecretKey($secretKey);

try {
    $result = $user->login($email, $redirect);
    print_r($result->getRaw());
    print_r($result->getArray());
} catch (Exception $e) {
    print_r($e->getMessage());
}

