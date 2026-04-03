<?php
$currentAct = $_GET['act'] ?? 'home';
$navCategories = $navCategories ?? (class_exists('CategoryModel') ? (new CategoryModel())->getAll() : []);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Agile Food | Đặt món trực tuyến') ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" type="image/png" href="http://localhost/Nhom3-Agile/Du-an-agile/uploads/logo.png">

    <style>
        :root {
            --lux-gold: #D4AF37;
            --lux-gold-glow: rgba(212, 175, 55, 0.5);
            --lux-black: #0A0A0A;
            --lux-dark-gray: #121212;
            --glass: rgba(255, 255, 255, 0.03);
        }

        body {
            background-color: var(--lux-black);
            font-family: Arial, Helvetica, sans-serif;
            color: rgba(255, 255, 255, 0.85);
            overflow-x: hidden;
        }

        /* --- Nền hạt lấp lánh (Animated Background) --- */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% 50%, #1a1a1a 0%, #0a0a0a 100%);
            z-index: -1;
        }

        /* --- Navbar Luxury Cải tiến --- */
        .navbar-luxury {
            background: rgba(10, 10, 10, 0.8) !important;
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
            padding: 1rem 0;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-luxury.scrolled {
            padding: 0.6rem 0;
            background: rgba(10, 10, 10, 0.95) !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .navbar-brand-lux {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 700;
            letter-spacing: 4px;
            transition: 0.3s;
        }

        .navbar-brand-lux:hover {
            transform: scale(1.05);
            text-shadow: 0 0 15px var(--lux-gold-glow);
        }

        /* Hiệu ứng gạch chân hiện đại cho Nav Link */
        .nav-link-lux {
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.75rem;
            letter-spacing: 2px;
            margin: 0 5px;
        }

        .nav-link-lux::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: 0;
            left: 50%;
            background: var(--lux-gold);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link-lux:hover::after, .nav-link-lux.active::after {
            width: 70%;
        }

        /* --- Dropdown ổn định cho Danh mục --- */
        .dropdown-menu-lux {
            background: rgba(18, 18, 18, 0.98);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 10px;
            min-width: 220px;
        }

        .dropdown-item-lux {
            color: rgba(255, 255, 255, 0.85);
            transition: all 0.2s ease;
        }

        .dropdown-item-lux:hover,
        .dropdown-item-lux:focus {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.1), transparent);
            color: var(--lux-gold);
            transform: translateX(4px);
        }

        /* --- Giỏ hàng & Badge --- */
        .cart-icon-wrapper {
            transition: all 0.3s;
            position: relative;
        }

        .cart-icon-wrapper:hover {
            transform: translateY(-3px) scale(1.1);
        }

        .badge-lux {
            animation: pulse-gold 2s infinite;
        }

        @keyframes pulse-gold {
            0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); }
            100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
        }

        .text-gold {
            color: var(--lux-gold) !important;
        }

        .badge-lux {
            position: absolute;
            top: -4px;
            right: -8px;
            background: var(--lux-gold);
            color: #000;
            border-radius: 999px;
            padding: 2px 6px;
            font-size: 0.65rem;
            font-weight: 700;
        }

        /* --- Buttons --- */
        .btn-auth-lux {
            position: relative;
            overflow: hidden;
            z-index: 1;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 0.9rem;
        }

        .btn-login-lux {
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
        }

        .btn-reg-lux {
            background: var(--lux-gold);
            color: #000;
            border: none;
        }

        .btn-reg-lux::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-reg-lux:hover::before {
            left: 100%;
        }

        .main-content-wrapper {
            min-height: calc(100vh - 180px);
        }

        /* --- Alerts Cải tiến --- */
        .alert-lux {
            border-radius: 0;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255,255,255,0.05);
            border-left: 4px solid var(--lux-gold);
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>

<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
    <div class="container">
        <a class="navbar-brand navbar-brand-lux animate__animated animate__fadeInDown" href="index.php?act=home">
            AGILE <span style="color: var(--lux-gold);">FOOD</span>
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="fa-solid fa-bars-staggered text-white"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-1">
                <?php 
                $menuItems = [
                    'home' => 'Trang chủ',
                    'about' => 'Giới thiệu',
                    'posts' => 'Bài viết',
                    'menu' => 'Thực đơn'
                ];
                foreach ($menuItems as $act => $label): 
                ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-lux <?= ($currentAct === $act || ($act === 'home' && $currentAct === '/')) ? 'active' : '' ?>" 
                       href="index.php?act=<?= $act ?>"><?= $label ?></a>
                </li>
                <?php endforeach; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-lux dropdown-toggle <?= ($currentAct === 'menu' && !empty($_GET['category_id'])) ? 'active' : '' ?>"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh mục</a>
                    <ul class="dropdown-menu dropdown-menu-lux">
                        <li><a class="dropdown-item dropdown-item-lux" href="index.php?act=menu">Tất cả sản phẩm</a></li>
                        <li><hr class="dropdown-divider opacity-25"></li>
                        <?php if (empty($navCategories)): ?>
                            <li><span class="dropdown-item text-secondary">Chưa có danh mục</span></li>
                        <?php else: ?>
                            <?php foreach (array_slice($navCategories, 0, 3) as $category): ?>
                                <li>
                                    <a class="dropdown-item dropdown-item-lux" href="index.php?act=menu&category_id=<?= (int) $category['id'] ?>">
                                        <?= e($category['name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3 animate__animated animate__fadeInRight">
                <?php if (!empty($_SESSION['user'])): ?>
                    <div class="nav-item dropdown me-2">
                        <a class="nav-link nav-link-lux dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-circle-user me-1 text-gold"></i> <?= e($_SESSION['user']['name'] ?? '') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lux dropdown-menu-end">
                            <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                                <li><a class="dropdown-item dropdown-item-lux text-warning" href="index.php?act=admin"><i class="fa-solid fa-gear me-2"></i>Quản trị</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item dropdown-item-lux" href="index.php?act=profile"><i class="fa-solid fa-user me-2"></i>Thông tin</a></li>
                                <li><a class="dropdown-item dropdown-item-lux" href="index.php?act=cart"><i class="fa-solid fa-cart-shopping me-2"></i>Giỏ hàng</a></li>
                                <li><a class="dropdown-item dropdown-item-lux" href="index.php?act=my-orders"><i class="fa-solid fa-receipt me-2"></i>Đơn hàng</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider opacity-25"></li>
                            <li><a class="dropdown-item dropdown-item-lux" href="index.php?act=logout"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Thoát</a></li>
                        </ul>
                    </div>

                    <?php if (($_SESSION['user']['role'] ?? '') === 'customer'): ?>
                        <a href="index.php?act=cart" class="cart-icon-wrapper p-2 text-decoration-none">
                            <i class="fa-solid fa-cart-shopping fs-5"></i>
                            <span class="badge badge-lux"><?= (int) ($cartCount ?? 0) ?></span>
                        </a>
                    <?php endif; ?>

                <?php else: ?>
                    <a href="index.php?act=login" class="btn btn-auth-lux btn-login-lux">Đăng nhập</a>
                    <a href="index.php?act=register" class="btn btn-auth-lux btn-reg-lux shadow-sm">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<main class="main-content-wrapper container py-5 animate__animated animate__fadeIn">
    <div class="notification-area">
        <?php if ($success = getFlash('success')): ?>
            <div class="alert alert-lux alert-dismissible fade show border-success" role="alert">
                <i class="fa-solid fa-circle-check text-success me-2"></i> <?= $success ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error = getFlash('error')): ?>
            <div class="alert alert-lux alert-dismissible fade show border-danger" role="alert">
                <i class="fa-solid fa-circle-exclamation text-danger me-2"></i> <?= $error ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>