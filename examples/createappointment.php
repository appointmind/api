<?php
require_once '../../../autoload.php';

$uri = '';
$accessKey = '';
$secretKey = '';

$user = new \Appointmind\Appointment();
$user->setUri($uri);
$user->setAccessKey($accessKey);
$user->setSecretKey($secretKey);

try {
    $result = $user->create(new DateTime('2018-02-01 10:40:00'));
    print_r($result->getRaw());
    print_r($result->getArray());
} catch (Exception $e) {
    print_r($e->getMessage());
}

