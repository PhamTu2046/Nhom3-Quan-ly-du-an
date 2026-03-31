<?php

class CategoryModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT categories.*, COALESCE(product_stats.product_count, 0) AS product_count
                FROM categories
                LEFT JOIN (
                    SELECT category_id, COUNT(*) AS product_count
                    FROM products
                    WHERE deleted_at IS NULL
                    GROUP BY category_id
                ) AS product_stats ON categories.id = product_stats.category_id
                ORDER BY categories.id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function create($name, $description)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO categories(name, description, created_at, updated_at)
             VALUES(?, ?, NOW(), NOW())"
        );
        $stmt->execute([$name, $description]);
    }

    public function update($id, $name, $description)
    {
        $stmt = $this->conn->prepare(
            "UPDATE categories
             SET name = ?, description = ?, updated_at = NOW()
             WHERE id = ?"
        );
        $stmt->execute([$name, $description, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function countAll()
    {
        return (int) $this->conn->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    }
}