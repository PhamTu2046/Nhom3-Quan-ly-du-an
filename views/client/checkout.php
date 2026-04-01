<?php require './views/client/layouts/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --ultra-gold: #D4AF37;
        --deep-noir: #0A0A0A;
        --glass-panel: rgba(255, 255, 255, 0.03);
    }

    body {
        background-color: var(--deep-noir);
        color: rgba(255,255,255,0.8);
        font-family: 'Inter', sans-serif;
    }

    /* Tiêu đề Section */
    .checkout-header {
        padding: 60px 0 40px;
        text-align: center;
    }

    .checkout-title {
        font-family: 'Cinzel', serif;
        font-size: 2.5rem;
        color: white;
        letter-spacing: -1px;
    }

    .checkout-subtitle {
        font-family: 'Cinzel', serif;
        font-size: 0.8rem;
        color: var(--ultra-gold);
        letter-spacing: 6px;
        text-transform: uppercase;
    }

    /* Glassmorphism Card */
    .glass-card {
        background: var(--glass-panel);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 0;
        padding: 40px;
    }

    /* Form Styling */
    .form-label {
        font-family: 'Cinzel', serif;
        font-size: 0.75rem;
        color: var(--ultra-gold);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.02) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 0;
        color: white !important;
        padding: 12px 15px;
        transition: 0.4s;
    }

    .form-control:focus {
        border-color: var(--ultra-gold) !important;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.1);
    }

    .form-control:disabled {
        opacity: 0.5;
        background: transparent !important;
    }

    /* Payment Method Selection */
    .payment-option {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        padding: 15px;
        margin-bottom: 10px;
        transition: 0.3s;
        cursor: pointer;
    }

    .payment-option:hover {
        border-color: var(--ultra-gold);
    }

    .form-check-input:checked + .form-check-label {
        color: var(--ultra-gold);
        font-weight: 600;
    }

    .form-check-input:checked {
        background-color: var(--ultra-gold);
        border-color: var(--ultra-gold);
    }

    /* Order Summary Side */
    .order-summary {
        border-left: 1px solid rgba(212, 175, 55, 0.2);
    }

    .item-row {
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        padding: 15px 0;
    }

    .total-amount {
        font-family: 'Cinzel', serif;
        font-size: 1.8rem;
        color: var(--ultra-gold);
        text-shadow: 0 0 10px rgba(212, 175, 55, 0.2);
    }

    /* Buttons */
    .btn-lux {
        border-radius: 0;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: 600;
        padding: 15px 35px;
        transition: 0.5s;
    }

    .btn-gold {
        background: var(--ultra-gold);
        color: var(--deep-noir);
        border: 1px solid var(--ultra-gold);
    }

    .btn-gold:hover {
        background: transparent;
        color: var(--ultra-gold);
        box-shadow: 0 0 25px rgba(212, 175, 55, 0.3);
    }

    .btn-outline-white {
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
    }
</style>

<div class="container pb-5 mb-5">
    <header class="checkout-header">
        <span class="checkout-subtitle">Final Confirmation</span>
        <h1 class="checkout-title">Hoàn tất đơn hàng</h1>
        <div style="width: 80px; height: 1px; background: var(--ultra-gold); margin: 20px auto;"></div>
    </header>

    <div class="row g-5">
        <div class="col-lg-7">
            <div class="glass-card shadow-lg animate__animated animate__fadeInLeft">
                <h4 class="cinzel-font text-white mb-4"><i class="fa-solid fa-feather-pointed text-gold me-2"></i> Thông tin Thượng khách</h4>
                
                <form action="index.php?act=place-order" method="POST">
                    <div class="mb-4">
                        <label class="form-label">Danh tính hội viên</label>
                        <input type="text" class="form-control" value="<?= e($_SESSION['user']['name'] ?? '') ?>" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Đường dây liên lạc</label>
                            <input type="text" name="phone" class="form-control" value="<?= e($_SESSION['user']['phone'] ?? '') ?>" placeholder="Số điện thoại nhận hàng...">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Địa chỉ thư điện tử</label>
                            <input type="email" class="form-control" value="<?= e($_SESSION['user']['email'] ?? '') ?>" disabled>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tọa độ nhận hàng (Địa chỉ)</label>
                        <textarea name="address" rows="3" class="form-control" placeholder="Vui lòng nhập địa chỉ chi tiết..."><?= e($_SESSION['user']['address'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label d-block mb-3">Phương thức quyết toán</label>
                        
                        <div class="payment-option">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label ms-2" for="cod">
                                    <i class="fa-solid fa-hand-holding-dollar me-2 opacity-50"></i> Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                        </div>

                        <div class="payment-option">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                                <label class="form-check-label ms-2" for="online">
                                    <i class="fa-solid fa-credit-card me-2 opacity-50"></i> Chuyển khoản trực tuyến (E-Payment)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-5">
                        <a href="index.php?act=cart" class="btn btn-lux btn-outline-white flex-grow-1 text-center text-decoration-none">
                            Quay lại giỏ hàng
                        </a>
                        <button type="submit" class="btn btn-lux btn-gold flex-grow-1">
                            Xác nhận đặt đơn
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="glass-card h-100 order-summary animate__animated animate__fadeInRight">
                <h4 class="cinzel-font text-white mb-4">Chi tiết Mỹ vị</h4>
                
                <div class="order-items-scroll pe-2" style="max-height: 400px; overflow-y: auto;">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="d-flex justify-content-between align-items-center item-row">
                            <div>
                                <div class="fw-bold text-white cinzel-font" style="letter-spacing: 1px;"><?= e($item['name']) ?></div>
                                <small class="text-white-50">Số lượng: <?= (int) $item['quantity'] ?> đơn vị</small>
                            </div>
                            <div class="fw-semibold text-white-50"><?= formatCurrency($item['price'] * $item['quantity']) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5 pt-4 border-top border-secondary">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-white-50 small text-uppercase letter-spacing-1">Phí phục vụ</span>
                        <span class="text-white small">Complimentary</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <span class="cinzel-font text-white fs-5">Tổng giá trị</span>
                        <span class="total-amount"><?= formatCurrency($cartTotal) ?></span>
                    </div>
                </div>

                <div class="mt-5 p-4" style="background: rgba(212, 175, 55, 0.05); border: 1px dashed var(--ultra-gold);">
                    <small class="text-white-50 d-block text-center italic fw-light">
                        <i class="fa-solid fa-quote-left me-2 opacity-50"></i>
                        Cảm ơn Quý khách đã lựa chọn Agile Food. Đơn hàng của Quý khách sẽ được chuẩn bị bởi những đầu bếp tâm huyết nhất.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar cho danh sách món */
    .order-items-scroll::-webkit-scrollbar { width: 3px; }
    .order-items-scroll::-webkit-scrollbar-track { background: transparent; }
    .order-items-scroll::-webkit-scrollbar-thumb { background: var(--ultra-gold); }
    .letter-spacing-1 { letter-spacing: 2px; }
</style>

<?php require './views/client/layouts/footer.php'; ?>