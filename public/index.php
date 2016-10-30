<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Framework\Application;

// load .env variables
$dotenv = new Dotenv\Dotenv(__DIR__ ."/..");
$dotenv->load();

Application::run();