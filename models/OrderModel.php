<?php

class OrderModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function createOrder($userId, $totalPrice, $paymentMethod, array $cartItems)
    {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO orders(user_id, total_price, status, payment_method, created_at, updated_at)
                 VALUES(?, ?, 'pending', ?, NOW(), NOW())"
            );
            $stmt->execute([$userId, $totalPrice, $paymentMethod]);

            $orderId = (int) $this->conn->lastInsertId();

            $itemStmt = $this->conn->prepare(
                "INSERT INTO order_items(order_id, product_id, price, quantity)
                 VALUES(?, ?, ?, ?)"
            );

            foreach ($cartItems as $item) {
                $itemStmt->execute([
                    $orderId,
                    $item['product_id'],
                    $item['price'],
                    $item['quantity'],
                ]);
            }

            $clearCartStmt = $this->conn->prepare("DELETE FROM carts WHERE user_id = ?");
            $clearCartStmt->execute([$userId]);

            $this->conn->commit();

            return $orderId;
        } catch (Throwable $exception) {
            $this->conn->rollBack();
            throw $exception;
        }
    }

    public function getByUserId($userId)
    {
        $stmt = $this->conn->prepare(
            "SELECT orders.*, COALESCE(item_stats.total_items, 0) AS total_items
             FROM orders
             LEFT JOIN (
                SELECT order_id, COUNT(*) AS total_items
                FROM order_items
                GROUP BY order_id
             ) AS item_stats ON orders.id = item_stats.order_id
             WHERE orders.user_id = ?
             ORDER BY orders.id DESC"
        );
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public function getAll($limit = null)
    {
        $sql = "SELECT orders.*, users.name AS user_name, users.email, users.phone,
                       COALESCE(item_stats.total_items, 0) AS total_items
                FROM orders
                LEFT JOIN users ON orders.user_id = users.id
                LEFT JOIN (
                    SELECT order_id, COUNT(*) AS total_items
                    FROM order_items
                    GROUP BY order_id
                ) AS item_stats ON orders.id = item_stats.order_id
                ORDER BY orders.id DESC";

        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int) $limit;
        }

        return $this->conn->query($sql)->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare(
            "UPDATE orders SET status = ?, updated_at = NOW() WHERE id = ?"
        );
        $stmt->execute([$status, $id]);
    }

    public function countAll()
    {
        return (int) $this->conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    }

    public function countPending()
    {
        return (int) $this->conn->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn();
    }

    public function getRevenue()
    {
        return (float) $this->conn->query(
            "SELECT COALESCE(SUM(total_price), 0) FROM orders WHERE status IN ('processing', 'completed')"
        )->fetchColumn();
    }
}