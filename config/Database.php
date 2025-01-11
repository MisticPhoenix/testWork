<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private $pdo;
    private static $instance = null;
    private $host = '127.0.0.1';
    private $dbname = 'products';
    private $user = 'root';
    private $password = '';

    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}