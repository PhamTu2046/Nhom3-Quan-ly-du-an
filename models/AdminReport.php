<?php

class AdminReport
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // 1. Tổng doanh thu
    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_price) as total 
                FROM orders 
                WHERE status = 'completed'";
        return $this->conn->query($sql)->fetch();
    }

    // 2. Doanh thu theo ngày
    public function getRevenueByDay()
    {
        $sql = "SELECT DATE(created_at) as date, SUM(total_price) as total
                FROM orders
                WHERE status = 'completed'
                GROUP BY DATE(created_at)
                ORDER BY date ASC";
        return $this->conn->query($sql)->fetchAll();
    }

    // 3. Doanh thu theo tháng
    public function getRevenueByMonth()
    {
        $sql = "SELECT MONTH(created_at) as month, SUM(total_price) as total
                FROM orders
                WHERE status = 'completed'
                GROUP BY MONTH(created_at)
                ORDER BY month ASC";
        return $this->conn->query($sql)->fetchAll();
    }

    // 4. Tổng số đơn hàng
    public function getTotalOrders()
    {
        $sql = "SELECT COUNT(*) as total FROM orders";
        return $this->conn->query($sql)->fetch();
    }

    // 5. Số đơn theo ngày
    public function getOrdersByDay()
    {
        $sql = "SELECT DATE(created_at) as date, COUNT(*) as total
                FROM orders
                GROUP BY DATE(created_at)";
        return $this->conn->query($sql)->fetchAll();
    }
}