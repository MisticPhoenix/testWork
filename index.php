<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Router;

// Настройка маршрутов
$router = new Router();

// Пример маршрутов
$router->get('/', [\Controllers\ProductController::class, 'getVisibleProducts']);
$router->get('/{count}', [\Controllers\ProductController::class, 'getVisibleProducts']);
$router->post('/api/products', [\Controllers\ProductController::class, 'store']);
$router->delete('/api/products/destroy/{id}', [\Controllers\ProductController::class, 'destroy']);
$router->put('/api/products/update/{id}', [\Controllers\ProductController::class, 'update']);

// Запуск маршрутизатора
$router->run();