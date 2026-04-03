<?php

require_once './models/AdminReport.php';

class AdminController
{
    public function dashboard()
    {
        $adminReport = new AdminReport();

        $totalRevenue = $adminReport->getTotalRevenue();
        $totalOrders = $adminReport->getTotalOrders();
        $revenueByDay = $adminReport->getRevenueByDay();
        $revenueByMonth = $adminReport->getRevenueByMonth();
        $ordersByDay = $adminReport->getOrdersByDay();

        require './views/admin/dashboard/index.php';
    }
}