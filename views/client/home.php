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
            object-fit: cover;
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
    </style>
</head>
<body>

<?php require './views/client/layouts/header.php'; ?>

    <section class="hero">
        <div class="container">
            <p class="text-uppercase mb-2" style="letter-spacing: 5px;">Tinh hoa ẩm thực Việt</p>
            <h1>Trải Nghiệm Hương Vị Thượng Lưu</h1>
            <a href="#menu" class="btn btn-gold">KHÁM PHÁ THỰC ĐƠN</a>
        </div>
    </section>

    <section class="container py-5" id="menu">
        <h2 class="section-title">Thực Đơn Đặc Sắc</h2>
        <div class="row">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card food-card">
                            <img src="<?= !empty($product['image']) ? 'uploads/' . htmlspecialchars($product['image'] ?? '') : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80' ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name'] ?? '') ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['name'] ?? '') ?></h5>
                                <p class="card-text text-secondary small"><?= htmlspecialchars($product['description'] ?? '') ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</span>
                                    <button class="btn btn-outline-warning btn-sm"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-white">Hiện chưa có sản phẩm nào.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php require './views/client/layouts/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>