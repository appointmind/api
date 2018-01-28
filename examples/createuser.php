<?php
require_once '../../../autoload.php';

use Appointmind\User;


$uri = '';
$accessKey = '';
$secretKey = '';


$user = new User();
$user->setUri($uri);
$user->setAccessKey($accessKey);
$user->setSecretKey($secretKey);
$user->create([
    'firstName' => 'Abby',
    'lastName' => 'Normal',
    'email' => 'abby.normal@example.com',
    'password' => 'test',
]);
