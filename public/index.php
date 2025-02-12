<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__ . '/../config');
$dotenv->load();

session_start();

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
