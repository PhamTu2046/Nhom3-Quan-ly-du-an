<?php

class UserModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getUserByCredential($credential, $password)
    {
        $sql = "SELECT *
                FROM users
                WHERE (email = :credential OR name = :credential)
                  AND password = :password
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':credential' => $credential,
            ':password' => $password,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertUser($username, $password, $email, $phone, $address, $role)
    {
        $sql = "INSERT INTO users (name, password, email, phone, address, role, created_at, updated_at)
                VALUES (:name, :password, :email, :phone, :address, :role, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $username,
            ':password' => $password,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':role' => $role,
        ]);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll($limit = null)
    {
        $sql = "SELECT users.*, COALESCE(order_stats.order_count, 0) AS order_count
                FROM users
                LEFT JOIN (
                    SELECT user_id, COUNT(*) AS order_count
                    FROM orders
                    GROUP BY user_id
                ) AS order_stats ON users.id = order_stats.user_id
                ORDER BY users.id DESC";

        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int) $limit;
        }

        return $this->conn->query($sql)->fetchAll();
    }

    public function countCustomers()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE role = 'customer'");
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function updateContact($id, $phone, $address)
    {
        $stmt = $this->conn->prepare(
            "UPDATE users SET phone = ?, address = ?, updated_at = NOW() WHERE id = ?"
        );
        $stmt->execute([$phone, $address, $id]);
    }
}