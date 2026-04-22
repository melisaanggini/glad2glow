<?php
require_once __DIR__ . '/../../config/database.php';

class Category {
    private $conn;
    private $table = 'categories';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM {$this->table} ORDER BY name ASC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getBySlug($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1");
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        return $stmt->fetch();
    }
}
