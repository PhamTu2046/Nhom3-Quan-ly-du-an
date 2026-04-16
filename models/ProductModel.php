<?php

class ProductModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT products.*, categories.name AS category_name
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                WHERE products.deleted_at IS NULL
                ORDER BY products.id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    public function getFiltered($keyword = '', $categoryId = 0)
    {
        $sql = "SELECT products.*, categories.name AS category_name
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                WHERE products.deleted_at IS NULL";
        $params = [];

        if ($keyword !== '') {
            $sql .= " AND (products.name LIKE :keyword OR products.description LIKE :keyword)";
            $params[':keyword'] = '%' . $keyword . '%';
        }

        if ($categoryId > 0) {
            $sql .= " AND products.category_id = :category_id";
            $params[':category_id'] = $categoryId;
        }

        $sql .= " ORDER BY products.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getTrash()
    {
        $sql = "SELECT products.*, categories.name AS category_name
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                WHERE products.deleted_at IS NOT NULL
                ORDER BY products.id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    public function insert($name, $price, $category_id, $description, $image)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO products(name, price, category_id, description, image, created_at, updated_at)
             VALUES(?, ?, ?, ?, ?, NOW(), NOW())"
        );

        $stmt->execute([$name, $price, $category_id, $description, $image]);
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT products.*, categories.name AS category_name
             FROM products
             LEFT JOIN categories ON products.category_id = categories.id
             WHERE products.id = ?
             LIMIT 1"
        );
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function findActive($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT products.*, categories.name AS category_name
             FROM products
             LEFT JOIN categories ON products.category_id = categories.id
             WHERE products.id = ? AND products.deleted_at IS NULL
             LIMIT 1"
        );
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function getRelated($categoryId, $excludeId, $limit = 4)
    {
        $limit = (int) $limit;
        $stmt = $this->conn->prepare(
            "SELECT products.*, categories.name AS category_name
             FROM products
             LEFT JOIN categories ON products.category_id = categories.id
             WHERE products.deleted_at IS NULL
               AND products.category_id = ?
               AND products.id <> ?
             ORDER BY products.id DESC
             LIMIT $limit"
        );
        $stmt->execute([$categoryId, $excludeId]);

        return $stmt->fetchAll();
    }

    public function update($id, $name, $price, $category_id, $description, $image)
    {
        $stmt = $this->conn->prepare(
            "UPDATE products
             SET name = ?, price = ?, category_id = ?, description = ?, image = ?, updated_at = NOW()
             WHERE id = ?"
        );

        $stmt->execute([$name, $price, $category_id, $description, $image, $id]);
    }

    public function softDelete($id)
    {
        $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NOW(), updated_at = NOW() WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function restore($id)
    {
        $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NULL, updated_at = NOW() WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function forceDelete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function countAll()
    {
        return (int) $this->conn->query("SELECT COUNT(*) FROM products WHERE deleted_at IS NULL")->fetchColumn();
    }

    public function countByCategory($categoryId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM products WHERE category_id = ? AND deleted_at IS NULL");
        $stmt->execute([$categoryId]);

        return (int) $stmt->fetchColumn();
    }
}
