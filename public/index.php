<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

use Core\Router;

// Настройка маршрутов
$router = new Router();

// Пример маршрутов
$router->get('/', [\Controllers\ProductController::class, 'getVisibleProducts']);
$router->get('/{count}', [\Controllers\ProductController::class, 'getVisibleProducts']);
$router->post('/api/products', [\Controllers\ProductController::class, 'store']);
$router->delete('/api/products/destroy/{id}', [\Controllers\ProductController::class, 'destroy']);

// Запуск маршрутизатора
$router->run();