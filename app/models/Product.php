<?php
require_once __DIR__ . '/../../config/database.php';

class Product {
    private $conn;
    private $table = 'products';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT p.*, c.name as category_name FROM {$this->table} p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC");
        return $stmt->fetchAll();
    }

    public function getBestsellers($limit = 4) {
        $stmt = $this->conn->prepare("SELECT p.*, c.name as category_name FROM {$this->table} p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_bestseller = 1 LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNewProducts($limit = 4) {
        $stmt = $this->conn->prepare("SELECT p.*, c.name as category_name FROM {$this->table} p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_new = 1 ORDER BY p.created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCategory($categoryId, $limit = 12) {
        $stmt = $this->conn->prepare("SELECT p.*, c.name as category_name FROM {$this->table} p LEFT JOIN categories c ON p.category_id = c.id WHERE p.category_id = :category_id LIMIT :limit");
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug FROM {$this->table} p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getRelated($categoryId, $excludeId, $limit = 4) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE category_id = :cat_id AND id != :exclude_id LIMIT :limit");
        $stmt->bindValue(':cat_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':exclude_id', $excludeId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
