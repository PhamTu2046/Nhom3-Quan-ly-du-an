<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách sản phẩm 
    public function getAll() {
        $sql = "SELECT products.*, categories.name as category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.deleted_at IS NULL
        ";
        return $this->conn->query($sql)->fetchAll();
    }

    public function getTrash() {
        $sql = "SELECT products.*, categories.name as category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.deleted_at IS NOT NULL
        ";
        return $this->conn->query($sql)->fetchAll();
    }

    public function insert($name, $price, $category_id, $description, $image) {
        $stmt = $this->conn->prepare("
            INSERT INTO products(name, price, category_id, description, image)
            VALUES(?, ?, ?, ?, ?)
        ");
        $stmt->execute([$name, $price, $category_id, $description, $image]);
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $name, $price, $category_id, $description, $image) {
        $stmt = $this->conn->prepare("
            UPDATE products 
            SET name=?, price=?, category_id=?, description=?, image=? 
            WHERE id=?
        ");
        $stmt->execute([$name, $price, $category_id, $description, $image, $id]);
    }

    public function softDelete($id) {
        $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NOW() WHERE id=?");
        $stmt->execute([$id]);
    }

    public function restore($id) {
        $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NULL WHERE id=?");
        $stmt->execute([$id]);
    }

    public function forceDelete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
    }
}
