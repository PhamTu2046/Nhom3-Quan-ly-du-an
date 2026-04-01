<?php require './views/client/header.php'; ?>

<style>
    /* --- HỆ THỐNG BIẾN SUPREME --- */
    :root {
        --lux-gold: #D4AF37;
        --lux-gold-light: #F1D38A;
        --glass-dark: rgba(10, 10, 10, 0.8);
        --border-gold: rgba(212, 175, 55, 0.3);
    }

    body {
        background-color: #000 !important;
        color: #fff !important;
    }

    /* --- LỚP NỀN HÌNH ẢNH --- */
    .master-bg {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=2070'); 
        background-size: cover;
        background-position: center;
        filter: brightness(0.2) blur(6px);
        z-index: -1;
    }

    /* --- SHOWCASE CONTAINER --- */
    .showcase-vault {
        background: var(--glass-dark);
        backdrop-filter: blur(15px);
        border: 1px solid var(--border-gold);
        padding: 50px;
        position: relative;
        overflow: hidden;
    }

    .showcase-vault::before {
        content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 4px;
        background: linear-gradient(90deg, transparent, var(--lux-gold), transparent);
    }

    /* --- IMAGE STYLING --- */
    .product-main-img {
        border: 1px solid var(--border-gold);
        padding: 10px;
        background: rgba(255,255,255,0.03);
        transition: 0.5s;
    }
    
    .product-main-img:hover {
        border-color: var(--lux-gold);
        box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
    }

    /* --- TYPOGRAPHY --- */
    .product-title {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #fff;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .product-price {
        font-family: 'Inter', sans-serif;
        color: var(--lux-gold) !important;
        font-weight: 200;
        letter-spacing: 2px;
    }

    .category-label {
        font-family: 'Cinzel', serif;
        background: transparent !important;
        border: 1px solid var(--lux-gold);
        color: var(--lux-gold) !important;
        letter-spacing: 2px;
        padding: 8px 15px !important;
        border-radius: 0;
    }

    /* --- FORM & BUTTONS --- */
    .qty-input {
        background: transparent !important;
        border: 1px solid var(--border-gold) !important;
        color: var(--lux-gold) !important;
        border-radius: 0 !important;
        text-align: center;
        font-weight: bold;
    }

    .btn-lux-gold {
        background: var(--lux-gold) !important;
        color: #000 !important;
        border-radius: 0 !important;
        border: none;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 2px;
        padding: 12px 25px;
        transition: 0.4s;
    }

    .btn-lux-gold:hover {
        background: var(--lux-gold-light) !important;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
    }

    .btn-lux-outline {
        border: 1px solid rgba(255,255,255,0.2) !important;
        color: #fff !important;
        border-radius: 0 !important;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .btn-lux-outline:hover {
        border-color: var(--lux-gold) !important;
        color: var(--lux-gold) !important;
    }

    /* --- RELATED SECTION --- */
    .related-card {
        background: rgba(10, 10, 10, 0.6) !important;
        border: 1px solid var(--border-gold) !important;
        border-radius: 0 !important;
        transition: 0.4s;
    }

    .related-card:hover {
        transform: translateY(-5px);
        border-color: var(--lux-gold) !important;
    }

    .related-title {
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        color: #fff;
    }
</style>

<div class="master-bg"></div>

<div class="container py-5 mt-4">
    <?php $image = !empty($product['image']) ? 'uploads/' . basename($product['image']) : 'https://placehold.co/900x600/111/D4AF37?text=Gourmet+Food'; ?>
    
    <div class="showcase-vault animate__animated animate__fadeIn">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="position-relative animate__animated animate__zoomIn">
                    <img src="<?= e($image) ?>" alt="<?= e($product['name']) ?>" class="img-fluid product-main-img w-100" style="max-height: 500px; object-fit: cover;">
                </div>
            </div>
            
            <div class="col-lg-6 px-lg-5">
                <span class="badge category-label mb-4"><?= e($product['category_name'] ?? 'Elite Choice') ?></span>
                
                <h1 class="display-5 product-title mb-3"><?= e($product['name']) ?></h1>
                
                <div class="product-price display-6 mb-4"><?= formatCurrency($product['price']) ?></div>
                
                <div class="mb-4" style="border-left: 2px solid var(--lux-gold); padding-left: 20px;">
                    <p class="text-secondary" style="font-style: italic; line-height: 1.8;">
                        <?= nl2br(e($product['description'] ?: 'Tinh hoa ẩm thực được bếp trưởng chọn lọc tỉ mỉ, mang đến trải nghiệm hương vị khó quên cho quý khách.')) ?>
                    </p>
                </div>

                <div class="pt-4 border-top border-secondary mt-5">
                    <div class="d-flex gap-3 flex-wrap">
                        <?php if (isset($_SESSION['user']) && (($_SESSION['user']['role'] ?? '') === 'customer')): ?>
                            <form action="index.php?act=add-to-cart" method="POST" class="d-flex gap-3 align-items-center">
                                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                                <div class="qty-wrapper d-flex align-items-center border border-secondary">
                                    <input type="number" name="quantity" class="form-control qty-input border-0" min="1" value="1" style="width: 80px;">
                                </div>
                                <button type="submit" class="btn btn-lux-gold">Thêm vào bàn tiệc</button>
                            </form>
                        <?php else: ?>
                            <a href="index.php?act=login" class="btn btn-lux-gold">Đăng nhập để đặt món</a>
                        <?php endif; ?>
                        <a href="index.php?act=menu" class="btn btn-lux-outline d-flex align-items-center">
                            <i class="fa-solid fa-arrow-left-long me-2"></i> Trở lại thực đơn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($relatedProducts)): ?>
        <section class="mt-5 pt-5 animate__animated animate__fadeInUp">
            <div class="d-flex align-items-center mb-5">
                <h3 class="product-title mb-0 me-4">Món liên quan</h3>
                <div class="flex-grow-1" style="height: 1px; background: rgba(212, 175, 55, 0.2);"></div>
            </div>
            
            <div class="row g-4">
                <?php foreach ($relatedProducts as $item): ?>
                    <?php $relatedImage = !empty($item['image']) ? 'uploads/' . basename($item['image']) : 'https://placehold.co/600x400/111/D4AF37?text=Gourmet'; ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card related-card h-100 p-2">
                            <div class="overflow-hidden">
                                <img src="<?= e($relatedImage) ?>" class="card-img-top" alt="<?= e($item['name']) ?>" style="height: 200px; object-fit: cover; transition: 0.5s;">
                            </div>
                            <div class="card-body d-flex flex-column text-center pt-4">
                                <h5 class="related-title mb-2 text-uppercase"><?= e($item['name']) ?></h5>
                                <div class="product-price mb-4 small fw-bold"><?= formatCurrency($item['price']) ?></div>
                                <a href="index.php?act=product-detail&id=<?= (int) $item['id'] ?>" class="btn btn-lux-outline btn-sm mt-auto">Khám phá</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</div>

<?php require './views/client/footer.php'; ?>