<?php

class CartModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getByUserId($userId)
    {
        $stmt = $this->conn->prepare(
            "SELECT carts.*, products.name, products.price, products.image, categories.name AS category_name
             FROM carts
             INNER JOIN products ON carts.product_id = products.id
             LEFT JOIN categories ON products.category_id = categories.id
             WHERE carts.user_id = ? AND products.deleted_at IS NULL
             ORDER BY carts.id DESC"
        );
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public function findByUserAndProduct($userId, $productId)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM carts WHERE user_id = ? AND product_id = ? LIMIT 1"
        );
        $stmt->execute([$userId, $productId]);

        return $stmt->fetch();
    }

    public function addOrIncrement($userId, $productId, $quantity = 1)
    {
        $existingItem = $this->findByUserAndProduct($userId, $productId);

        if ($existingItem) {
            $stmt = $this->conn->prepare(
                "UPDATE carts SET quantity = quantity + ? WHERE id = ? AND user_id = ?"
            );
            $stmt->execute([$quantity, $existingItem['id'], $userId]);
            return;
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO carts(user_id, product_id, quantity, created_at)
             VALUES(?, ?, ?, NOW())"
        );
        $stmt->execute([$userId, $productId, $quantity]);
    }

    public function updateQuantity($cartId, $userId, $quantity)
    {
        if ($quantity <= 0) {
            $this->deleteItem($cartId, $userId);
            return;
        }

        $stmt = $this->conn->prepare(
            "UPDATE carts SET quantity = ? WHERE id = ? AND user_id = ?"
        );
        $stmt->execute([$quantity, $cartId, $userId]);
    }

    public function deleteItem($cartId, $userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE id = ? AND user_id = ?");
        $stmt->execute([$cartId, $userId]);
    }

    public function clearByUserId($userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE user_id = ?");
        $stmt->execute([$userId]);
    }

    public function countItems($userId)
    {
        $stmt = $this->conn->prepare("SELECT COALESCE(SUM(quantity), 0) FROM carts WHERE user_id = ?");
        $stmt->execute([$userId]);

        return (int) $stmt->fetchColumn();
    }
}