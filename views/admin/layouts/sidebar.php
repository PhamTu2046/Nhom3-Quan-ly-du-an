<?php $currentAct = $_GET['act'] ?? 'admin'; ?>
<div class="d-flex">
    <div class="bg-dark text-white p-3" style="width: 260px; min-height: 100vh;">
        <h4 class="text-center mb-2">🍽 Agile Food</h4>
        <p class="text-center text-white-50 small mb-4">Quản trị hệ thống bán Pizza, Burger và Đồ uống.</p>

        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="index.php?act=admin" class="nav-link text-white sidebar-link <?= $currentAct === 'admin' ? 'active' : '' ?>">📊 Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=list-product" class="nav-link text-white sidebar-link <?= in_array($currentAct, ['list-product', 'add-product', 'edit-product'], true) ? 'active' : '' ?>">🍔 Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=admin-categories" class="nav-link text-white sidebar-link <?= $currentAct === 'admin-categories' ? 'active' : '' ?>">📂 Danh mục</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=admin-orders" class="nav-link text-white sidebar-link <?= in_array($currentAct, ['admin-orders', 'update-order-status'], true) ? 'active' : '' ?>">🧾 Đơn hàng</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=admin-users" class="nav-link text-white sidebar-link <?= $currentAct === 'admin-users' ? 'active' : '' ?>">👤 Người dùng</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=admin-posts" class="nav-link text-white sidebar-link <?= in_array($currentAct, ['admin-posts', 'add-post', 'edit-post'], true) ? 'active' : '' ?>">📰 Bài viết</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=trash-product" class="nav-link text-white sidebar-link <?= $currentAct === 'trash-product' ? 'active' : '' ?>">🗑 Thùng rác sản phẩm</a>
            </li>

            <hr class="border-light opacity-25 my-3">

            <li class="nav-item">
                <a href="index.php?act=home" class="nav-link text-white sidebar-link">🏠 Xem trang client</a>
            </li>
            <li class="nav-item">
                <a href="index.php?act=logout" class="nav-link text-danger sidebar-link">🚪 Đăng xuất</a>
            </li>
        </ul>
    </div>