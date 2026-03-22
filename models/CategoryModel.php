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
}