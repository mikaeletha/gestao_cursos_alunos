<?php
require_once 'app/config/Routes.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = trim($url, '/');

// echo "URL processada: " . $url . "<br>";

handleRoute($url);