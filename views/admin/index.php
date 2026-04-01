<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --lux-gold: #c5a059;
        --lux-dark: #1e293b;
        --lux-bg: #f8fafc;
    }

    body { background-color: var(--lux-bg); font-family: 'Inter', sans-serif; }
    
    /* Stat Cards */
    .stat-card {
        border: none;
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        margin-bottom: 1rem;
    }

    /* Typography */
    .card-title-lux {
        font-weight: 700;
        color: var(--lux-dark);
        letter-spacing: -0.02em;
    }
    
    /* Table Styling */
    .table thead th {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #64748b;
        border: none;
        padding: 1rem;
    }
    .table tbody tr { border-bottom: 1px solid #f1f5f9; transition: 0.2s; }
    .table tbody tr:hover { background-color: #fcfcfc; }

    /* Custom Buttons */
    .btn-lux {
        border-radius: 12px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-lux-dark { background: var(--lux-dark); color: white; border: none; }
    .btn-lux-dark:hover { background: #000; color: white; transform: scale(1.02); }

    .badge-soft {
        padding: 0.5em 1em;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h2 class="fw-extrabold text-dark mb-1">Tổng quan hệ thống</h2>
        <p class="text-muted mb-0 small"><i class="fa-solid fa-calendar-day me-1"></i> Hôm nay, <?= date('d M Y') ?></p>
    </div>
    <button class="btn btn-white shadow-sm btn-lux border"><i class="fa-solid fa-download me-2"></i>Báo cáo</button>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="stat-icon bg-soft-primary text-primary" style="background: #e0f2fe;"><i class="fa-solid fa-utensils"></i></div>
                <div class="text-muted small fw-bold text-uppercase mb-1">Thực đơn</div>
                <div class="fs-2 fw-bold text-dark"><?= (int) $stats['products'] ?></div>
                <div class="small text-success fw-medium"><i class="fa-solid fa-arrow-up me-1"></i>Đang mở bán</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="stat-icon bg-soft-info text-info" style="background: #e0f7fa;"><i class="fa-solid fa-layer-group"></i></div>
                <div class="text-muted small fw-bold text-uppercase mb-1">Danh mục</div>
                <div class="fs-2 fw-bold text-dark"><?= (int) $stats['categories'] ?></div>
                <div class="small text-primary fw-medium">Nhóm món ăn</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="stat-icon bg-soft-warning text-warning" style="background: #fef3c7;"><i class="fa-solid fa-cart-shopping"></i></div>
                <div class="text-muted small fw-bold text-uppercase mb-1">Đơn hàng</div>
                <div class="fs-2 fw-bold text-dark"><?= (int) $stats['orders'] ?></div>
                <div class="small text-warning fw-medium">Chờ xử lý: <?= (int) $stats['pending_orders'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100 bg-dark text-white">
            <div class="card-body p-4">
                <div class="stat-icon" style="background: rgba(255,255,255,0.1);"><i class="fa-solid fa-coins text-warning"></i></div>
                <div class="text-white-50 small fw-bold text-uppercase mb-1 text-uppercase">Doanh thu</div>
                <div class="fs-4 fw-bold text-warning"><?= formatCurrency($stats['revenue']) ?></div>
                <div class="small text-white-50">Lợi nhuận gộp ước tính</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title-lux mb-0">Đơn hàng mới nhất</h5>
                <a href="index.php?act=admin-orders" class="btn btn-link text-decoration-none small fw-bold text-lux-dark">Xem tất cả <i class="fa-solid fa-arrow-right small ms-1"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Trạng thái</th>
                            <th class="text-end pe-4">Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentOrders)): ?>
                            <tr><td colspan="4" class="text-center text-muted py-5">Chưa có hoạt động giao dịch nào.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recentOrders as $order): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-muted small">#<?= (int) $order['id'] ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= e($order['user_name'] ?? 'Khách lẻ') ?></div>
                                        <div class="text-muted" style="font-size: 0.75rem;"><i class="fa-regular fa-clock me-1"></i><?= e(date('H:i, d/m', strtotime($order['created_at']))) ?></div>
                                    </td>
                                    <td>
                                        <?php 
                                            $badgeClass = match($order['status']) {
                                                'completed' => 'bg-success',
                                                'processing' => 'bg-primary',
                                                'cancelled' => 'bg-danger',
                                                default => 'bg-warning text-dark'
                                            };
                                        ?>
                                        <span class="badge rounded-pill <?= $badgeClass ?> shadow-none badge-soft" style="--bs-bg-opacity: .15; color: inherit;">
                                            <i class="fa-solid fa-circle me-1" style="font-size: 6px; vertical-align: middle;"></i> <?= e($order['status']) ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4 fw-bold text-dark"><?= formatCurrency($order['total_price']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <h5 class="card-title-lux mb-4">Lối tắt quản lý</h5>
                <div class="d-grid gap-3">
                    <a href="index.php?act=list-product" class="btn btn-lux btn-lux-dark d-flex align-items-center justify-content-between">
                        <span><i class="fa-solid fa-plus-circle me-2"></i>Thêm sản phẩm</span>
                        <i class="fa-solid fa-chevron-right small opacity-50"></i>
                    </a>
                    <a href="index.php?act=admin-categories" class="btn btn-white border btn-lux d-flex align-items-center justify-content-between">
                        <span><i class="fa-solid fa-tags me-2"></i>Danh mục món</span>
                        <i class="fa-solid fa-chevron-right small opacity-50"></i>
                    </a>
                    <a href="index.php?act=admin-posts" class="btn btn-white border btn-lux d-flex align-items-center justify-content-between">
                        <span><i class="fa-solid fa-pen-nib me-2"></i>Viết bài blog</span>
                        <i class="fa-solid fa-chevron-right small opacity-50"></i>
                    </a>
                    <a href="index.php?act=admin-users" class="btn btn-white border btn-lux d-flex align-items-center justify-content-between">
                        <span><i class="fa-solid fa-users me-2"></i>Người dùng</span>
                        <i class="fa-solid fa-chevron-right small opacity-50"></i>
                    </a>
                </div>
                
                <div class="mt-4 pt-4 border-top">
                    <h6 class="small fw-bold text-muted text-uppercase mb-3">Tóm tắt khách hàng</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Khách hàng mới</span>
                        <span class="fw-bold"><?= (int) $stats['customers'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Tỷ lệ hoàn tất</span>
                        <span class="fw-bold text-success">92%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<?php require './views/admin/layouts/footer.php'; ?>