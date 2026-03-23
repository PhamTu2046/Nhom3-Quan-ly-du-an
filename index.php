<?php
// ===== REQUIRE =====
require_once './commons/env.php';
require_once './commons/function.php';

require_once './controllers/ProductController.php';
require_once './controllers/AuthController.php';
require_once './controllers/CategoryController.php';

require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/UserModel.php';

// ===== SESSION =====
session_start();

// ===== LẤY ACT =====
$act = $_GET['act'] ?? 'login';

// ===== ROUTE KHÔNG CẦN LOGIN =====
$publicRoutes = ['login', 'check-login', 'register', 'check-register', 'home', 'gioithieu'];

// ===== CHẶN CHƯA LOGIN =====
if (!isset($_SESSION['user']) && !in_array($act, $publicRoutes)) {
    header('Location: index.php?act=login');
    exit();
}

// ===== ĐÃ LOGIN → KHÔNG CHO VÀO LOGIN/REGISTER =====
if (isset($_SESSION['user']) && in_array($act, ['login', 'register'])) {
    header('Location: index.php?act=list-product');
    exit();
}

// ===== ROUTE =====
match ($act) {

    // ===== AUTH =====
    'login' => (new AuthController())->showLogin(),
    'check-login' => (new AuthController())->login(),
    'register' => (new AuthController())->showRegister(),
    'check-register' => (new AuthController())->register(),
    'logout' => (new AuthController())->logout(),

    // ===== TRANG CHÍNH =====
    '/' => (new ProductController())->Home(),
    'home' => (new ProductController())->Home(),
    'gioithieu' => (new ProductController())->gioithieu(),

    // ===== ADMIN =====
    'admin' => (new ProductController())->index(),

    // ===== PRODUCT =====
    'list-product' => (new ProductController())->index(),
    'add-product' => (new ProductController())->create(),
    'store-product' => (new ProductController())->store(),

    'edit-product' => (new ProductController())->edit(),
    'update-product' => (new ProductController())->update(),

    'delete-product' => (new ProductController())->delete(),

    'trash-product' => (new ProductController())->trash(),
    'restore-product' => (new ProductController())->restore(),
    'force-delete-product' => (new ProductController())->forceDelete(),

    // ===== CATEGORY =====
    'list-category' => (new CategoryController())->index(),
    'add-category' => (new CategoryController())->create(),
    'store-category' => (new CategoryController())->store(),
    'edit-category' => (new CategoryController())->edit(),
    'update-category' => (new CategoryController())->update(),
    'delete-category' => (new CategoryController())->delete(),

    // ===== DEFAULT (TRÁNH LỖI MATCH) =====
    default => (new AuthController())->showLogin(),
};