<?php

use Firebase\JWT\JWT;

require './vendor/autoload.php';


$key = 'secret';

$payload = [
    'iss' => 'smkyaj',
    'aud' => 'smkyaj',
    'iat' => time(),
    'data' => [
        'id' => 1, // id user login
        'email' => 'dearahma867@gmail.com' // email user login
    ]
];

$token = JWT::encode($payload, $key, 'HS256');

echo $token;