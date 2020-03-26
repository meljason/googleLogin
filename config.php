<?php
require_once "GoogleAPI/vendor/autoload.php";

$googleClient = new Google_Client();
$googleClient->setClientId("311181393646-ip9cr65e748e463kn9o8kf2mc1orj648.apps.googleusercontent.com");
$googleClient->setClientSecret("gvukyOWT9-ONs0RcRQv5AfeO");
$googleClient->setRedirectUri("http://localhost/lab5-api-MelJason/index.php");
$googleClient->addScope('email');
$googleClient->addScope('profile');

session_start();
