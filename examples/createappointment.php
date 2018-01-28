<?php
require_once '../../../autoload.php';

$uri = 'http://hundert.scripts.local/schedule_organizer/www/?api=1';
$accessKey = 'rDdKPRenFsgjQ5SNL53ejKUMCMCkB';
$secretKey = '7pDVeNcM!xSDYdpbZTCzdxBm3&M?*g';

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

