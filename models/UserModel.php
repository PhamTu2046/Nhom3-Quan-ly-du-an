<?php

class UserModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getUserByEmailAndPassword($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':password' => $password
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByUsernameAndPassword($username, $password)
{
    $sql = "SELECT * FROM users WHERE name = :username AND password = :password LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $password
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function insertUser($username, $password, $email, $phone, $address, $role)
{
    $sql = "INSERT INTO users (name, password, email, phone, address, role) 
            VALUES (:name, :password, :email, :phone, :address, :role)";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':name' => $username,
        ':password' => $password,
        ':email' => $email,
        ':phone' => $phone,
        ':address' => $address,
        ':role' => $role
    ]);
}
public function getUserByEmail($email)
{
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}