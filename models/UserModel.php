<?php

class UserModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // ✅ LẤY USER THEO USERNAME (dùng cho login)
    public function getUserByUsername($username)
{
    $sql = "SELECT * FROM users WHERE name = :username LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':username' => $username
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // ✅ LẤY USER THEO EMAIL
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ INSERT USER (password đã hash từ controller)
    public function insertUser($username, $password, $email, $phone, $address, $role)
{
    $sql = "INSERT INTO users (name, password, email, phone, address, role)
            VALUES (:name, :password, :email, :phone, :address, :role)";
    
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':name' => $username,
        ':password' => $password,
        ':email' => $email,
        ':phone' => $phone,
        ':address' => $address,
        ':role' => $role
    ]);
}
}