<?php require './views/client/layouts/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --lux-gold: #D4AF37;
        --lux-gold-light: #F1D38A;
        --lux-gold-dark: #997a21;
        --lux-black: #0A0A0A;
        --lux-white: #FFFFFF;
        --lux-bg-content: #FDFBF8; 
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: var(--lux-bg-content);
        color: var(--lux-black);
        overflow-x: hidden;
    }

    /* --- HERO SECTION SUPREME --- */
    .hero-banner {
        background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.8)), 
                        url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2070&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 160px 0;
        position: relative;
        border-bottom: 3px solid var(--lux-gold);
    }

    /* Hiệu ứng hạt bụi vàng lơ lửng */
    .hero-banner::before {
        content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        opacity: 0.3; pointer-events: none;
    }

    .hero-title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 4.5rem;
        font-weight: 900;
        color: var(--lux-white);
        letter-spacing: -2px;
        text-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .hero-title span {
        display: block;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 2.2rem;
        font-weight: 400;
        font-style: italic;
        color: var(--lux-gold-light);
        letter-spacing: 4px;
        margin-top: 10px;
    }

    /* --- GLASS SEARCH CARD --- */
    .glass-search-card {
        background: rgba(10, 10, 10, 0.45) !important;
        backdrop-filter: blur(25px) saturate(150%);
        -webkit-backdrop-filter: blur(25px) saturate(150%);
        border: 1px solid rgba(212, 175, 55, 0.3) !important;
        border-radius: 0;
        box-shadow: 0 40px 100px rgba(0,0,0,0.6);
    }

    /* --- LUXURY PRODUCT CARDS --- */
    .lux-card {
        border: 1px solid rgba(0,0,0,0.03) !important;
        border-radius: 0;
        background-color: white;
        transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .lux-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.12) !important;
        border-color: var(--lux-gold) !important;
    }

    /* Luồng sáng quét ngang khi hover */
    .img-wrapper {
        position: relative; overflow: hidden;
    }
    .img-wrapper::after {
        content: ""; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transform: skewX(-25deg); transition: 0.6s;
    }
    .lux-card:hover .img-wrapper::after { left: 150%; }

    .lux-badge {
        background: var(--lux-gold);
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.6rem;
        letter-spacing: 3px;
        padding: 8px 16px;
        border-radius: 0;
    }

    .price-tag {
        font-family: Arial, Helvetica, sans-serif;
        color: var(--lux-gold-dark);
        font-size: 1.4rem;
        font-weight: 700;
    }

    /* --- BLOG SECTION (JOURNAL) --- */
    .blog-section {
        background-color: var(--lux-black);
        background-image: radial-gradient(circle at center, #1a1a1a 0%, #050505 100%);
        padding: 120px 0;
        border-top: 2px solid var(--lux-gold);
    }

    .blog-card-lux {
        background: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(212, 175, 55, 0.1) !important;
        transition: 0.5s;
    }

    .blog-card-lux:hover {
        background: rgba(255, 255, 255, 0.06) !important;
        border-color: var(--lux-gold) !important;
    }

    /* --- BUTTONS --- */
    .btn-lux-primary {
        background: var(--lux-black);
        color: white;
        border-radius: 0;
        padding: 15px 35px;
        ffont-family: Arial, Helvetica, sans-serif;
        letter-spacing: 3px;
        font-size: 0.75rem;
        border: 1px solid var(--lux-gold);
        transition: 0.5s;
        position: relative;
        overflow: hidden;
    }

    .btn-lux-primary:hover {
        background: var(--lux-gold);
        color: black;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
    }

    .section-title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 3.2rem;
        font-weight: 700;
        letter-spacing: 2px;
        background: linear-gradient(135deg, var(--lux-black) 0%, #444 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-gold { color: var(--lux-gold) !important; font-family: Arial, Helvetica, sans-serif; }

    /* Fix cho hiện tên người dùng */
    .navbar-luxury .nav-link {
    color: rgba(255,255,255,0.9) !important;
    }

    .navbar-luxury .nav-link:hover {
        color: #D4AF37 !important;
    }

    .navbar-luxury i {
        color: #fff !important;
    }
    .navbar-luxury i {
        color: var(--lux-gold) !important;
    }

    .cart-icon-wrapper i {
        color: #0d6efd !important; /* màu xanh cart */
    }

    .navbar-luxury .fa-circle-user {
        color: var(--lux-gold) !important;
    }
</style>

<div class="container-fluid p-0">
    <section class="hero-banner">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 animate__animated animate__fadeInLeft">
                    <span class="hero-brand-sub mb-3 d-block text-gold">Hệ thống đặt món trực tuyến</span>
                    <h1 class="hero-title">AGILE FOOD <span>Pizza - Burger - Đồ uống</span></h1>
                    <p class="lead opacity-75 mt-4 fw-light text-white" style="max-width: 600px; line-height: 2;">
                        Dự án hỗ trợ khách hàng xem thực đơn, thêm món vào giỏ hàng và đặt đơn trực tuyến nhanh chóng, phù hợp với dữ liệu sản phẩm hiện có của hệ thống.
                    </p>
                </div>
                <div class="col-lg-5 animate__animated animate__fadeInRight">
                    <div class="card glass-search-card text-white">
                        <div class="card-body p-5">
                            <h3 class="text-gold mb-4" style="font-family: Arial, Helvetica, sans-serif;">Tìm kiếm món ăn</h3>
                            <form action="index.php" method="GET">
                                <input type="hidden" name="act" value="home">
                                <div class="mb-4">
                                    <label class="small text-white-50 text-uppercase mb-2 d-block letter-spacing-huge">Tìm kiếm sản phẩm</label>
                                    <input type="text" name="keyword" class="form-control bg-transparent text-white border-secondary rounded-0 py-3 shadow-none" 
                                           value="<?= e($_GET['keyword'] ?? '') ?>" placeholder="Tên kiệt tác ẩm thực...">
                                </div>
                                <div class="mb-5">
                                    <label class="small text-white-50 text-uppercase mb-2 d-block letter-spacing-huge">Danh mục</label>
                                    <select name="category_id" class="form-select bg-transparent text-white border-secondary rounded-0 py-3 shadow-none">
                                        <option class="text-dark" value="0">Tất cả danh mục</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option class="text-dark" value="<?= (int) $category['id'] ?>" <?= ((int) ($_GET['category_id'] ?? 0) === (int) $category['id']) ? 'selected' : '' ?>>
                                                <?= e($category['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-lux-primary w-100 py-3">Khám phá ngay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5 mt-5">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-4">
            <div>
                <span class="text-gold letter-spacing-Huge d-block mb-2">Món ăn nổi bật</span>
                <h2 class="section-title" style=" -webkit-text-fill-color: white;">Thực đơn nổi bật</h2>
                <div style="width: 120px; height: 2px; background: var(--lux-gold); margin-top: 15px;"></div>
            </div>
            <div class="d-flex gap-3">
                <a href="index.php?act=menu" class="btn btn-lux-primary">Xem Toàn Bộ Thực Đơn</a>
            </div>
        </div>

        <div class="row g-5">
            <?php if (empty($products)): ?>
                <div class="col-12 py-5 text-center">
                    <p class="text-muted fs-4 fw-light italic">Thực đơn đang được Bếp trưởng cập nhật...</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $index => $product): ?>
                    <?php
                        $image = !empty($product['image']) ? 'uploads/' . basename($product['image']) : 'https://placehold.co/600x600/111/D4AF37?text=Gourmet';
                        $description = $product['description'] ?: 'Kiệt tác ẩm thực đang được hoàn thiện mô tả.';
                        $shortDescription = mb_strlen($description) > 95 ? mb_substr($description, 0, 95) . '...' : $description;
                    ?>
                    <div class="col-md-6 col-xl-4 animate__animated animate__fadeInUp" style="animation-delay: <?= $index * 0.1 ?>s">
                        <div class="card lux-card h-100 shadow-sm">
                            <div class="img-wrapper">
                                <span class="lux-badge position-absolute"><?= e($product['category_name'] ?? 'ELITE') ?></span>
                                <img src="<?= e($image) ?>" class="card-img-top" alt="<?= e($product['name']) ?>" style="height: 320px;">
                            </div>
                            <div class="card-body p-4 d-flex flex-column text-center">
                                <h4 class="card-title text-uppercase fw-bold mb-3" style="font-family: Arial, Helvetica, sans-serif; letter-spacing: 1px;"><?= e($product['name']) ?></h4>
                                <p class="card-text text-muted mb-4 small px-2" style="line-height: 1.8; font-style: italic;"><?= e($shortDescription) ?></p>
                                <div class="mt-auto pt-4 border-top">
                                    <div class="price-tag mb-4"><?= number_format($product['price']) ?> <small style="font-size: 0.8rem; letter-spacing: 1px;">VND</small></div>
                                    <div class="d-grid">
                                        <a href="index.php?act=product-detail&id=<?= (int) $product['id'] ?>" class="btn btn-lux-primary">Chi tiết mỹ vị</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($posts)): ?>
        <section class="blog-section mt-5">
            <div class="container text-center">
                <div class="mb-5">
                    <span class="text-gold letter-spacing-Huge d-block">Journal & Legacy</span>
                    <h2 class="section-title text-white" style="background: none; -webkit-text-fill-color: white;">Ký sự Thánh đường</h2>
                </div>

                <div class="row g-4">
                    <?php foreach ($posts as $post): ?>
                        <?php
                            $postImage = !empty($post['image']) ? 'uploads/' . basename($post['image']) : 'https://placehold.co/600x400/111/D4AF37?text=Journal';
                            $shortPost = mb_strlen($post['content']) > 120 ? mb_substr($post['content'], 0, 120) . '...' : $post['content'];
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card blog-card-lux rounded-0 h-100 border-0">
                                <img src="<?= e($postImage) ?>" class="card-img-top rounded-0" style="height: 250px; object-fit: cover; filter: sepia(30%) brightness(80%);">
                                <div class="card-body p-4 text-start">
                                    <h5 class="text-white text-uppercase mb-3" style="font-family: Arial, Helvetica, sans-serif; letter-spacing: 1px;"><?= e($post['title']) ?></h5>
                                    <p class="text-white-50 small mb-4 fw-light" style="line-height: 1.8;"><?= e($shortPost) ?></p>
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                                        <span class="text-gold fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 2px;">Read Memoir</span>
                                        <small class="text-white-50 opacity-50"><?= !empty($post['created_at']) ? date('M d, Y', strtotime($post['created_at'])) : '' ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>

<?php require './views/client/layouts/footer.php'; ?>