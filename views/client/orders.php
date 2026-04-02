<?php require './views/client/layouts/header.php'; ?>
<?php
$statusClasses = [
    'pending' => 'order-pending',
    'processing' => 'order-processing',
    'completed' => 'order-completed',
    'cancelled' => 'order-cancelled',
];
$statusLabels = [
    'pending' => 'Chờ xác nhận',
    'processing' => 'Đang xử lý',
    'completed' => 'Hoàn thành',
    'cancelled' => 'Đã hủy',
];
?>

<style>
    :root {
        --lux-gold: #D4AF37;
        --lux-gold-light: #F1D38A;
        --glass-dark: rgba(10, 10, 10, 0.85);
        --border-gold: rgba(212, 175, 55, 0.25);
    }

    body {
        background-color: #000 !important;
        color: #fff !important;
    }

    /* --- BACKGROUND LAYER --- */
    .master-bg {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=2070');
        background-size: cover;
        background-position: center;
        filter: brightness(0.2) blur(5px);
        z-index: -1;
    }

    /* --- TITLES --- */
    .lux-header-title {
        font-family: 'Cinzel', serif;
        color: var(--lux-gold);
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    /* --- GLASS CARD --- */
    .order-vault-card {
        background: var(--glass-dark) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--border-gold) !important;
        border-radius: 0 !important; /* Giữ góc vuông Elite */
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
    }

    /* --- TABLE STYLING --- */
    .table {
        color: rgba(255, 255, 255, 0.8) !important;
        border-collapse: separate;
        border-spacing: 0 10px; /* Tạo khoảng cách giữa các dòng */
    }

    .table thead th {
        font-family: 'Cinzel', serif;
        color: var(--lux-gold) !important;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        border: none !important;
        background: transparent !important;
        padding-bottom: 20px;
    }

    .table tbody tr {
        background: rgba(255, 255, 255, 0.03);
        transition: all 0.4s ease;
    }

    .table tbody tr:hover {
        background: rgba(212, 175, 55, 0.08);
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 20px !important;
        border: none !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        border-bottom: 1px solid rgba(255,255,255,0.05) !important;
    }

    .order-id {
        color: var(--lux-gold-light);
        font-weight: 900;
        letter-spacing: 1px;
    }

    .price-total {
        color: var(--lux-gold) !important;
        font-weight: 700;
        font-size: 1.1rem;
    }

    /* --- STATUS BADGES --- */
    .badge-elite {
        padding: 8px 15px;
        border-radius: 0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 1px;
        border: 1px solid currentColor;
        background: transparent;
    }

    .order-pending { color: #ffc107; }
    .order-processing { color: #0dcaf0; }
    .order-completed { color: #198754; box-shadow: 0 0 10px rgba(25, 135, 84, 0.3); }
    .order-cancelled { color: #dc3545; opacity: 0.7; }

    /* --- BUTTONS --- */
    .btn-lux-outline {
        border: 1px solid var(--lux-gold);
        color: var(--lux-gold);
        border-radius: 0;
        font-family: 'Cinzel', serif;
        font-size: 0.7rem;
        letter-spacing: 1px;
        transition: 0.4s;
    }

    .btn-lux-outline:hover {
        background: var(--lux-gold);
        color: #000;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
    }
</style>

<div class="master-bg"></div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate__animated animate__fadeIn">
        <div>
            <h1 class="h2 lux-header-title mb-1">Đơn hàng của tôi</h1>
            <p class="text-secondary mb-0" style="font-style: italic;">"Lịch sử những lần thưởng thức tinh hoa tại Thánh Đường."</p>
        </div>
        <a href="index.php?act=menu" class="btn btn-lux-outline px-4 py-2">
            <i class="fa-solid fa-plus me-2"></i>Tiếp tục mua hàng
        </a>
    </div>

    <div class="card order-vault-card animate__animated animate__fadeInUp">
        <div class="card-body p-4 p-md-5">
            <?php if (empty($orders)): ?>
                <div class="text-center py-5">
                    <i class="fa-solid fa-receipt fs-1 mb-4 text-secondary opacity-25"></i>
                    <h4 class="lux-header-title">Trống trải như một bàn tiệc chưa bày</h4>
                    <p class="text-secondary">Hãy đặt món đầu tiên để hệ thống bắt đầu theo dõi cho bạn.</p>
                    <a href="index.php?act=menu" class="btn btn-lux-outline px-5 py-3 mt-3">Đặt món ngay</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Thời gian</th>
                                <th>Số món</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                                <th class="text-center">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><span class="order-id">#<?= (int) $order['id'] ?></span></td>
                                    <td>
                                        <div class="small"><?= e(date('d/m/Y', strtotime($order['created_at']))) ?></div>
                                        <div class="text-muted x-small"><?= e(date('H:i', strtotime($order['created_at']))) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge border border-secondary text-secondary"><?= (int) $order['total_items'] ?> món</span>
                                    </td>
                                    <td>
                                        <i class="fa-solid <?= $order['payment_method'] === 'online' ? 'fa-credit-card' : 'fa-hand-holding-dollar' ?> me-2 small"></i>
                                        <?= $order['payment_method'] === 'online' ? 'Online' : 'Tiền mặt' ?>
                                    </td>
                                    <td><span class="price-total"><?= formatCurrency($order['total_price']) ?></span></td>
                                    <td class="text-center">
                                        <span class="badge-elite <?= $statusClasses[$order['status']] ?? 'text-secondary' ?>">
                                            <i class="fa-solid fa-circle-dot me-1 small"></i>
                                            <?= e($statusLabels[$order['status']] ?? $order['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require './views/client/layouts/footer.php'; ?>