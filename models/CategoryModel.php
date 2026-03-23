<?php

class CategoryModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll() {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insert($name) {
        $stmt = $this->conn->prepare("INSERT INTO categories(name) VALUES(?)");
        $stmt->execute([$name]);
    }

    public function update($id, $name) {
        $stmt = $this->conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }
}