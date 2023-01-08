<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('clicker', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('getTop100', 'RankingController');

Routing::post('loginUser', 'SecurityController');
Routing::post('registerUser', 'SecurityController');

Routing::Run($path);