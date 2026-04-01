<?php require './views/client/layouts/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&display=swap" rel="stylesheet">

<style>
    /* --- HỆ THỐNG MÀU ELITE --- */
    :root {
        --lux-gold: #D4AF37;
        --lux-gold-light: #F1D38A;
        --glass: rgba(15, 15, 15, 0.85);
        --border-gold: rgba(212, 175, 55, 0.3);
    }

    /* Đảm bảo body hiển thị đúng nền */
    body {
        background-color: #000 !important;
        color: #fff !important;
        position: relative;
    }

    /* --- LỚP NỀN HÌNH ẢNH (PHẢI CÓ) --- */
    .master-bg {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        filter: brightness(0.3) blur(2px); /* Làm tối nền để nổi bật món ăn */
        z-index: -1; /* Đẩy xuống cùng */
    }

    /* --- KHUNG BỘ LỌC (FILTER SECTION) --- */
    .lux-filter-box {
        background: var(--glass) !important;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-gold);
        border-radius: 0;
        padding: 40px !important;
        margin-bottom: 50px;
        position: relative;
        z-index: 10;
    }

    .lux-title {
        font-family: 'Cinzel', serif;
        color: var(--lux-gold) !important;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-weight: 700;
    }

    /* --- THIẾT KẾ CARD MÓN ĂN (MENU CARD) --- */
    .menu-item-card {
        background: rgba(10, 10, 10, 0.9) !important;
        border: 1px solid var(--border-gold) !important;
        border-radius: 0 !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        position: relative;
        z-index: 5;
    }

    .menu-item-card:hover {
        transform: translateY(-10px);
        border-color: var(--lux-gold) !important;
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
    }

    /* Họa tiết góc mạ vàng */
    .corner-decor {
        position: absolute;
        width: 20px; height: 20px;
        border: 1px solid var(--lux-gold);
        opacity: 0.4;
        transition: 0.4s;
        z-index: 2;
    }
    .top-left { top: 10px; left: 10px; border-right: 0; border-bottom: 0; }
    .bottom-right { bottom: 10px; right: 10px; border-left: 0; border-top: 0; }
    
    .menu-item-card:hover .corner-decor {
        width: 40px; height: 40px; opacity: 1;
    }

    .card-img-container {
        overflow: hidden;
        height: 250px;
    }

    .card-img-container img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: 0.6s;
    }

    .menu-item-card:hover .card-img-container img {
        transform: scale(1.1);
    }

    /* --- TEXT & BUTTONS --- */
    .product-name {
        font-family: 'Cinzel', serif;
        font-size: 1.25rem;
        color: #6f5252;
        margin-top: 15px;
    }

    .product-price {
        color: var(--lux-gold) !important;
        font-size: 1.4rem;
        font-weight: 300;
    }

    .btn-elite {
        background: transparent;
        color: var(--lux-gold) !important;
        border: 1px solid var(--lux-gold) !important;
        border-radius: 0;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 2px;
        padding: 10px 20px;
        transition: 0.4s;
    }

    .btn-elite:hover {
        background: var(--lux-gold) !important;
        color: #000 !important;
    }

    /* Tùy chỉnh input cho tối màu */
    .form-control, .form-select {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid var(--border-gold) !important;
        color: #9e6e6e !important;
        border-radius: 0;
    }
</style>

<div class="master-bg"></div>

<div class="container py-5">
    <section class="lux-filter-box animate__animated animate__fadeIn">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h1 class="lux-title mb-1">Thực Đơn Tất Cả Món Ăn</h1>
                <p class="text-muted mb-0">Khám phá tinh hoa ẩm thực được lọc theo phong cách riêng của quý khách.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge border border-warning text-warning px-3 py-2 fs-6">
                    <?= count($products) ?> Tuyệt phẩm
                </span>
            </div>
        </div>

        <form action="index.php" method="GET" class="row g-3">
            <input type="hidden" name="act" value="menu">
            <div class="col-md-5">
                <label class="small text-uppercase text-muted mb-2">Tìm kiếm tên món</label>
                <input type="text" name="keyword" class="form-control" value="<?= e($_GET['keyword'] ?? '') ?>" placeholder="Nhập tên món ăn...">
            </div>
            <div class="col-md-4">
                <label class="small text-uppercase text-muted mb-2">Phân loại danh mục</label>
                <select name="category_id" class="form-select">
                    <option value="0">Tất cả danh mục</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category['id'] ?>" <?= ((int) ($_GET['category_id'] ?? 0) === (int) $category['id']) ? 'selected' : '' ?>>
                            <?= e($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-grid align-self-end">
                <button type="submit" class="btn btn-elite p-2" style="background: var(--lux-gold) !important; color: #000 !important;">Lọc Thực Đơn</button>
            </div>
        </form>
    </section>

    <div class="row g-4">
        <?php if (empty($products)): ?>
            <div class="col-12">
                <div class="lux-filter-box text-center py-5">
                    <h3 class="lux-title">Không tìm thấy kết quả</h3>
                    <p class="text-muted">Quý khách vui lòng thử lại với từ khóa hoặc danh mục khác.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <?php $image = !empty($product['image']) ? 'uploads/' . basename($product['image']) : 'https://placehold.co/600x400/222/D4AF37?text=Gourmet'; ?>
                <div class="col-md-6 col-xl-4 animate__animated animate__fadeInUp">
                    <div class="card menu-item-card">
                        <div class="corner-decor top-left"></div>
                        <div class="corner-decor bottom-right"></div>
                        
                        <div class="card-img-container">
                            <img src="<?= e($image) ?>" alt="<?= e($product['name']) ?>">
                        </div>
                        
                        <div class="card-body d-flex flex-column p-4">
                            <span class="text-warning small text-uppercase fw-bold mb-2" style="letter-spacing: 2px;">
                                <?= e($product['category_name'] ?? 'Elite') ?>
                            </span>
                            <h5 class="product-name"><?= e($product['name']) ?></h5>
                            <p class="text-muted small flex-grow-1">
                                <?= e($product['description'] ?: 'Hương vị tuyệt hảo từ bếp trưởng Thánh Đường Mỹ Vị.') ?>
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <strong class="product-price"><?= formatCurrency($product['price']) ?></strong>
                                <div class="btn-group">
                                    <a href="index.php?act=product-detail&id=<?= (int) $product['id'] ?>" class="btn btn-elite me-2">Chi tiết</a>
                                    <?php if (!empty($_SESSION['user']) && (($_SESSION['user']['role'] ?? '') === 'customer')): ?>
                                        <a href="index.php?act=add-to-cart&id=<?= (int) $product['id'] ?>" class="btn btn-elite" style="background: var(--lux-gold) !important; color: #000 !important;">+ Giỏ</a>
                                    <?php else: ?>
                                        <a href="index.php?act=login" class="btn btn-elite" style="background: var(--lux-gold) !important; color: #000 !important;">Mua ngay</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require './views/client/layouts/footer.php'; ?>