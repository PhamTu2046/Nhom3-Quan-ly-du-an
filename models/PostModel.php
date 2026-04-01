<?php

class PostModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        try {
            return $this->conn->query("SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();
        } catch (PDOException $exception) {
            return [];
        }
    }

    public function getLatest($limit = 3)
    {
        try {
            $limit = (int) $limit;
            $sql = "SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY id DESC LIMIT $limit";
            return $this->conn->query($sql)->fetchAll();
        } catch (PDOException $exception) {
            return [];
        }
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = ? AND deleted_at IS NULL LIMIT 1");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function create($title, $content, $image)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO posts(title, content, image, created_at, updated_at)
             VALUES(?, ?, ?, NOW(), NOW())"
        );
        $stmt->execute([$title, $content, $image]);
    }

    public function update($id, $title, $content, $image)
    {
        $stmt = $this->conn->prepare(
            "UPDATE posts
             SET title = ?, content = ?, image = ?, updated_at = NOW()
             WHERE id = ?"
        );
        $stmt->execute([$title, $content, $image, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("UPDATE posts SET deleted_at = NOW(), updated_at = NOW() WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function countAll()
    {
        try {
            return (int) $this->conn->query("SELECT COUNT(*) FROM posts WHERE deleted_at IS NULL")->fetchColumn();
        } catch (PDOException $exception) {
            return 0;
        }
    }
}