<?php
// ===== REQUIRE =====
require_once './commons/env.php';
require_once './commons/function.php';

require_once './controllers/ProductController.php';
require_once './controllers/AuthController.php';
require_once './controllers/AdminController.php';

require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/UserModel.php';
require_once './models/CartModel.php';
require_once './models/OrderModel.php';
require_once './models/PostModel.php';

// ===== SESSION =====
session_start();

// ===== LẤY ACT =====
$act = $_GET['act'] ?? 'home';

// ===== ROUTE KHÔNG CẦN LOGIN =====
$publicRoutes = ['/', 'home', 'about', 'posts', 'menu', 'product-detail', 'login', 'check-login', 'register', 'check-register', 'logout'];

if (!isset($_SESSION['user']) && !in_array($act, $publicRoutes, true)) {
    setFlash('error', 'Vui lòng đăng nhập để tiếp tục.');
    header('Location: index.php?act=login');
    exit();
}

if (isset($_SESSION['user']) && in_array($act, ['login', 'register'], true)) {
    header('Location: index.php?act=' . (($_SESSION['user']['role'] ?? '') === 'admin' ? 'admin' : 'home'));
    exit();
}

match ($act) {
    // ===== VNPAY =====
    'vnpay_return' => (new ProductController())->vnpayReturn(),
    
    // ===== AUTH =====
    'login' => (new AuthController())->showLogin(),
    'check-login' => (new AuthController())->login(),
    'register' => (new AuthController())->showRegister(),
    'check-register' => (new AuthController())->register(),
    'logout' => (new AuthController())->logout(),

    // ===== CLIENT =====
    '/' => (new ProductController())->Home(),
    'home' => (new ProductController())->Home(),
    'about' => (new ProductController())->about(),
    'posts' => (new ProductController())->posts(),
    'menu' => (new ProductController())->menu(),
    'product-detail' => (new ProductController())->show(),
    'cart' => (new ProductController())->cart(),
    'add-to-cart' => (new ProductController())->addToCart(),
    'update-cart' => (new ProductController())->updateCart(),
    'remove-cart' => (new ProductController())->removeCartItem(),
    'checkout' => (new ProductController())->checkout(),
    'place-order' => (new ProductController())->placeOrder(),
    'my-orders' => (new ProductController())->myOrders(),
    'profile' => (new AuthController())->profile(),
    'update-profile' => (new AuthController())->updateProfile(),

    // ===== ADMIN =====
    'admin' => (new ProductController())->dashboard(),
    'admin-orders' => (new ProductController())->adminOrders(),
    'update-order-status' => (new ProductController())->updateOrderStatus(),
    'admin-users' => (new ProductController())->adminUsers(),
    'admin-categories' => (new ProductController())->adminCategories(),
    'save-category' => (new ProductController())->saveCategory(),
    'delete-category' => (new ProductController())->deleteCategory(),
    'admin-posts' => (new ProductController())->adminPosts(),
    'add-post' => (new ProductController())->createPost(),
    'store-post' => (new ProductController())->storePost(),
    'edit-post' => (new ProductController())->editPost(),
    'update-post' => (new ProductController())->updatePost(),
    'delete-post' => (new ProductController())->deletePost(),
    'trash-post' => (new ProductController())->trashPost(),
    'restore-post' => (new ProductController())->restorePost(),
    'force-delete-post' => (new ProductController())->forceDeletePost(),
    'admin-report' => (new AdminController())->dashboard(),

    // ===== PRODUCT ADMIN =====
    'list-product' => (new ProductController())->index(),
    'add-product' => (new ProductController())->create(),
    'store-product' => (new ProductController())->store(),
    'edit-product' => (new ProductController())->edit(),
    'update-product' => (new ProductController())->update(),
    'delete-product' => (new ProductController())->delete(),
    'trash-product' => (new ProductController())->trash(),
    'restore-product' => (new ProductController())->restore(),
    'force-delete-product' => (new ProductController())->forceDelete(),

    default => (new ProductController())->Home(),
};