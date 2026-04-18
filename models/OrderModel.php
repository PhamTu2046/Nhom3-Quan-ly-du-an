<?php

class OrderModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    private function attachItemsToOrders(array $orders)
    {
        if (empty($orders)) {
            return [];
        }

        $orderIds = array_map(static function ($order) {
            return (int) $order['id'];
        }, $orders);

        $placeholders = implode(', ', array_fill(0, count($orderIds), '?'));
        $itemStmt = $this->conn->prepare(
            "SELECT order_items.order_id,
                    order_items.product_id,
                    order_items.price,
                    order_items.quantity,
                    products.name AS product_name,
                    products.image AS product_image,
                    categories.name AS category_name
             FROM order_items
             LEFT JOIN products ON order_items.product_id = products.id
             LEFT JOIN categories ON products.category_id = categories.id
             WHERE order_items.order_id IN ($placeholders)
             ORDER BY order_items.order_id DESC, order_items.product_id ASC"
        );
        $itemStmt->execute($orderIds);

        $itemsByOrderId = [];
        foreach ($itemStmt->fetchAll() as $item) {
            $itemsByOrderId[(int) $item['order_id']][] = $item;
        }

        foreach ($orders as &$order) {
            $order['items'] = $itemsByOrderId[(int) $order['id']] ?? [];
        }
        unset($order);

        return $orders;
    }

    public function createOrder($userId, $totalPrice, $paymentMethod, $contactPhone, $deliveryAddress, array $cartItems)
    {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO orders(
                    user_id,
                    total_price,
                    status,
                    payment_method,
                    contact_phone,
                    delivery_address,
                    created_at,
                    updated_at
                )
                VALUES(?, ?, 'pending', ?, ?, ?, NOW(), NOW())"
            );
            $stmt->execute([
                $userId,
                $totalPrice,
                $paymentMethod,
                $contactPhone,
                $deliveryAddress,
            ]);

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
                SELECT order_id, COALESCE(SUM(quantity), 0) AS total_items
                FROM order_items
                GROUP BY order_id
             ) AS item_stats ON orders.id = item_stats.order_id
             WHERE orders.user_id = ?
             ORDER BY orders.id DESC"
        );
        $stmt->execute([$userId]);

        return $this->attachItemsToOrders($stmt->fetchAll());
    }

    public function findByIdAndUserId($orderId, $userId)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM orders
             WHERE id = ? AND user_id = ?
             LIMIT 1"
        );
        $stmt->execute([(int) $orderId, (int) $userId]);

        return $stmt->fetch();
    }

    public function cancelPendingByUser($orderId, $userId, $cancelReason, $cancelNote = '')
    {
        $stmt = $this->conn->prepare(
            "UPDATE orders
             SET status = 'cancelled',
                 cancel_reason = ?,
                 cancel_note = ?,
                 updated_at = NOW()
             WHERE id = ? AND user_id = ? AND status = 'pending'"
        );
        $stmt->execute([
            $cancelReason,
            $cancelNote !== '' ? $cancelNote : null,
            (int) $orderId,
            (int) $userId,
        ]);

        return $stmt->rowCount() > 0;
    }

    public function getAll($limit = null)
    {
        $sql = "SELECT orders.*,
                       users.name AS user_name,
                       users.email AS user_email,
                       users.phone AS user_phone,
                       COALESCE(item_stats.total_items, 0) AS total_items
                FROM orders
                LEFT JOIN users ON orders.user_id = users.id
                LEFT JOIN (
                    SELECT order_id, COALESCE(SUM(quantity), 0) AS total_items
                    FROM order_items
                    GROUP BY order_id
                ) AS item_stats ON orders.id = item_stats.order_id
                ORDER BY orders.id DESC";

        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int) $limit;
        }

        return $this->attachItemsToOrders($this->conn->query($sql)->fetchAll());
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
