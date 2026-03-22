<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';

// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'=>(new ProductController())->Home(),

    'list-product' => (new ProductController())->index(),
    'add-product' => (new ProductController())->create(),
    'store-product' => (new ProductController())->store(),

    'edit-product' => (new ProductController())->edit(),
    'update-product' => (new ProductController())->update(),

    'delete-product' => (new ProductController())->delete(),

    'trash-product' => (new ProductController())->trash(),
    'restore-product' => (new ProductController())->restore(),
    'force-delete-product' => (new ProductController())->forceDelete(),

};