

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