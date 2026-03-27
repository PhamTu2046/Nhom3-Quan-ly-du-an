<?php

require_once './models/OrderModel.php';

class AdminController
{
    public function dashboard()
    {
        $orderModel = new OrderModel();

        $totalRevenue = $orderModel->getTotalRevenue();
        $totalOrders = $orderModel->getTotalOrders();
        $revenueByDay = $orderModel->getRevenueByDay();
        $revenueByMonth = $orderModel->getRevenueByMonth();
        $ordersByDay = $orderModel->getOrdersByDay();

        require './views/admin/dashboard/index.php';
    }
}