<?php require './views/client/layouts/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --lux-gold: #D4AF37;
        --lux-gold-dim: rgba(212, 175, 55, 0.2);
        --deep-dark: #0A0A0A;
        --glass-panel: rgba(255, 255, 255, 0.02);
    }

    body {
        background-color: var(--deep-dark);
        color: #d1d1d1;
        font-family: 'Inter', sans-serif;
    }

    /* Fix lỗi trắng: Ép bảng và container về nền tối */
    .cart-wrapper {
        background: var(--glass-panel) !important;
        border: 1px solid rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        margin-bottom: 2rem;
    }

    .table {
        background-color: transparent !important; /* Xóa bỏ màu trắng */
        color: #ffffff !important;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    /* Header của bảng */
    .table thead th {
        background-color: rgba(255, 255, 255, 0.03) !important;
        font-family: 'Cinzel', serif;
        color: var(--lux-gold) !important;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-bottom: 1px solid var(--lux-gold-dim) !important;
        padding: 20px !important;
    }

    /* Các hàng trong bảng */
    .cart-item-row {
        background-color: transparent !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        transition: all 0.3s ease;
    }

    .cart-item-row:hover {
        background-color: rgba(212, 175, 55, 0.02) !important;
    }

    .table td {
        background-color: transparent !important;
        padding: 25px 20px !important;
        border: none !important;
        vertical-align: middle;
    }

    /* Ảnh sản phẩm */
    .food-img-frame {
        width: 80px;
        height: 80px;
        border: 1px solid var(--lux-gold-dim);
        padding: 4px;
        background: #000;
    }

    .food-img-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Input số lượng sang trọng */
    .qty-input-lux {
        background: #111 !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: var(--lux-gold) !important;
        width: 60px !important;
        text-align: center;
        border-radius: 0 !important;
        font-weight: 600;
    }

    /* Thành tiền */
    .subtotal-text {
        font-family: 'Cinzel', serif;
        color: var(--lux-gold);
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Sidebar Thanh toán */
    .summary-card {
        background: #0f0f0f;
        border: 1px solid var(--lux-gold-dim);
        padding: 40px;
        position: sticky;
        top: 100px;
    }

    .summary-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 2px;
        background: linear-gradient(90deg, transparent, var(--lux-gold), transparent);
    }

    /* Buttons */
    .btn-lux {
        font-family: 'Cinzel', serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
        padding: 15px 25px;
        border-radius: 0;
        transition: 0.4s;
    }

    .btn-gold {
        background: var(--lux-gold);
        color: #000;
        border: 1px solid var(--lux-gold);
        font-weight: 900;
    }

    .btn-gold:hover {
        background: transparent;
        color: var(--lux-gold);
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
    }

    .btn-outline {
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .btn-outline:hover {
        border-color: var(--lux-gold);
        color: var(--lux-gold);
    }
</style>

<div class="container pb-5 mt-5">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <span style="color: var(--lux-gold); font-family: 'Cinzel'; letter-spacing: 5px; font-size: 0.8rem;">GOURMET EXPERIENCE</span>
        <h1 style="font-family: 'Cinzel'; color: #fff; font-size: 3rem; font-weight: 900; margin-top: 10px;">GIỎ HÀNG CỦA QUÝ KHÁCH</h1>
        <div style="width: 60px; height: 1px; background: var(--lux-gold); margin: 20px auto;"></div>
    </div>

    <?php if (empty($cartItems)): ?>
        <div class="text-center py-5">
            <h3 class="cinzel-font text-white-50">Giỏ hàng hiện đang trống</h3>
            <a href="index.php?act=home" class="btn btn-lux btn-gold mt-4">Quay lại thực đơn</a>
        </div>
    <?php else: ?>
        <form action="index.php?act=update-cart" method="POST">
            <div class="row g-5">
                <div class="col-lg-8 animate__animated animate__fadeInLeft">
                    <div class="cart-wrapper">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 45%;">Tuyệt phẩm</th>
                                        <th>Giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Thành tiền</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $item): ?>
                                    <?php $image = !empty($item['image']) ? 'uploads/' . basename($item['image']) : 'https://placehold.co/100x100?text=Food'; ?>
                                    <tr class="cart-item-row">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="food-img-frame d-none d-md-block shadow-sm">
                                                    <img src="<?= e($image) ?>" alt="<?= e($item['name']) ?>">
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-white fs-6 cinzel-font"><?= e($item['name']) ?></div>
                                                    <small class="text-white-50 small fw-light"><?= e($item['category_name'] ?? 'Premium') ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-white-50 small">
                                            <?= formatCurrency($item['price']) ?>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" min="1" name="quantities[<?= $item['id'] ?>]" class="form-control qty-input-lux mx-auto" value="<?= (int)$item['quantity'] ?>">
                                        </td>
                                        <td class="text-end subtotal-text">
                                            <?= formatCurrency($item['price'] * $item['quantity']) ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?act=remove-cart&id=<?= $item['id'] ?>" class="text-white-50" onclick="return confirm('Xóa khỏi giỏ hàng?')">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php?act=home" class="btn btn-lux btn-outline">
                            <i class="fa-solid fa-chevron-left me-2"></i> Tiếp tục lựa chọn
                        </a>
                        <button type="submit" class="btn btn-lux btn-outline">Cập nhật danh sách</button>
                    </div>
                </div>

                <div class="col-lg-4 animate__animated animate__fadeInRight">
                    <div class="summary-card shadow-lg">
                        <h5 class="cinzel-font text-white mb-4 border-bottom border-secondary pb-3">Thanh toán đơn hàng</h5>
                        
                        <div class="d-flex justify-content-between mb-3 fw-light">
                            <span class="text-white-50">Lựa chọn món ăn:</span>
                            <span class="text-white"><?= (int)$cartCount ?> sản phẩm</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 fw-light">
                            <span class="text-white-50">Phí dịch vụ:</span>
                            <span class="text-success small">Premium Free</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top border-secondary pt-4 mb-5">
                            <span class="cinzel-font text-white fs-5">Tổng cộng:</span>
                            <span class="subtotal-text fs-4"><?= formatCurrency($cartTotal) ?></span>
                        </div>

                        <div class="d-grid">
                            <a href="index.php?act=checkout" class="btn btn-lux btn-gold">Tiến hành đặt món</a>
                        </div>

                        <div class="mt-4 text-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg" height="20" class="opacity-25 grayscale mb-3">
                            <p class="text-white-50 italic small m-0" style="font-size: 0.65rem;">
                                <i class="fa-solid fa-shield-halved me-1"></i> BẢO MẬT THANH TOÁN SSL 256-BIT
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php require './views/client/footer.php'; ?>