<?php

namespace Controllers;

use Config\Database;
use Core\Controller;
use PDO;

class ProductController extends Controller
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPDO();
    }
    public function getVisibleProducts(int $limit = 10): void
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `products` WHERE `visible` = 1");
        $stmt->execute();
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->view("Products", ["products" => $products, "limit" => $limit]);
    }
    public function store(): bool
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $this->pdo->prepare("INSERT INTO `products` (name, price, quantity, visible) VALUES (:name, :price, :quantity, :visible)");
        return $stmt->execute([':name' => $data['name'], ':price' => $data['price'], ':quantity' => $data['quantity'], ':visible' => $data['visible']]);
    }

    public function destroy($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM `products` WHERE `id` = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function update($id, $name, $price, $quantity, $visible = 1): bool
    {
        $stmt = $this->pdo->prepare("UPDATE `products` SET `name` = :name, `price` = :price, `quantity` = :quantity, `visible` = :visible WHERE `id` = :id");
        return $stmt->execute([':id' => $id, ':name' => $name, ':price' => $price, ':quantity' => $quantity, ':visible' => $visible]);
    }
}