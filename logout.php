<?php
include('config.php');

$googleClient->revokeToken();
session_destroy();

header('Location: index.php');


?>