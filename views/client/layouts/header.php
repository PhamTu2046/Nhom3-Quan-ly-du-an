<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmet Haven | Ẩm Thực Đẳng Cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --gold: #C5A059;
            --dark: #0F0F0F;
            --dark-light: #1A1A1A;
            --white: #FFFFFF;
        }

        body {
            background-color: var(--dark);
            color: var(--white);
            font-family: 'Montserrat', sans-serif;
        }

        h1, h2, h3, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* --- Custom Navbar --- */
        .navbar {
            background-color: rgba(15, 15, 15, 0.95);
            border-bottom: 1px solid rgba(197, 160, 89, 0.2);
            padding: 20px 0;
        }

        .navbar-brand {
            color: var(--gold) !important;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            margin: 0 15px;
            transition: 0.3s;
            text-transform: uppercase;
            font-size: 13px;
        }

        .nav-link:hover {
            color: var(--gold) !important;
        }

        /* --- Hero Section --- */
        .hero {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero h1 {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .btn-gold {
            background-color: var(--gold);
            color: var(--dark);
            padding: 12px 35px;
            border-radius: 0;
            font-weight: 600;
            border: 2px solid var(--gold);
            transition: 0.4s;
        }

        .btn-gold:hover {
            background-color: transparent;
            color: var(--gold);
        }

        /* --- Food Card --- */
        .section-title {
            color: var(--gold);
            text-align: center;
            margin-bottom: 50px;
        }

        .food-card {
            background: var(--dark-light);
            border: 1px solid rgba(197, 160, 89, 0.1);
            transition: 0.4s;
            margin-bottom: 30px;
        }

        .food-card:hover {
            transform: translateY(-10px);
            border-color: var(--gold);
        }

        .food-card img {
            height: 250px;
            object-fit: fill;
        }

        .food-card .card-body {
            padding: 25px;
        }

        .price {
            color: var(--gold);
            font-size: 20px;
            font-weight: 600;
        }

        /* --- Badge Phân Quyền --- */
        .badge-admin {
            background: var(--gold);
            color: black;
            font-size: 10px;
            padding: 2px 8px;
            vertical-align: middle;
        }
        .card-title{
            color: white;
        }
        .dropdown-menu .text-white:hover {
            color: black !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">GOURMET <span style="color:white">HAVEN</span></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php?act=home">Trang Chủ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Danh Mục</a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white" href="#">Món Chính</a></li>
                            <li><a class="dropdown-item text-white" href="#">Đồ Uống</a></li>
                            <li><a class="dropdown-item text-white" href="#">Tráng Miệng</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="index.php?act=gioithieu">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tin Tức</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#">Món Ăn</a></li> -->

                </ul>

                <div class="d-flex align-items-center">
                    <a href="#" class="text-white me-4 position-relative">
                        <i class="fa-solid fa-bag-shopping fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">2</span>
                    </a>
                    
                    <span class="text-white me-3" style="font-size: 14px; font-weight: 500;">
                        Xin chào, <span style="color: var(--gold);">
                            <?php 
                                // Dùng tên bên user session (từ DB), fallback về Khách
                                if (isset($_SESSION['user']['name'])) {
                                    echo htmlspecialchars($_SESSION['user']['name']);
                                } elseif (isset($_SESSION['name'])) {
                                    echo htmlspecialchars($_SESSION['name']);
                                } else {
                                    echo 'Khách';
                                }
                            ?>
                        </span>
                    </span>

                    <a href="index.php?act=logout" class="btn btn-gold btn-sm">Đăng Xuất</a>
                </div>
            </div>
        </div>
    </nav>