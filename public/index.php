<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Framework\Application;
use App\Framework\Http\Request;
use App\Framework\Router\Router;
use App\Framework\Router\ControllerResolver;

// load .env variables
$dotenv = new Dotenv\Dotenv(base_dir());
$dotenv->load();

$router = new Router(base_dir('config/routes.yml'));
$app = new Application(new ControllerResolver($router));
$app->handle(Request::create())->send();