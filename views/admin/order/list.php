<?php require './views/layouts/header.php'; ?>

<?php
$statusClasses = [
    'pending' => 'bg-soft-warning text-warning',
    'processing' => 'bg-soft-primary text-primary',
    'completed' => 'bg-soft-success text-success',
    'cancelled' => 'bg-soft-danger text-danger',
];

$statusLabels = [
    'pending' => 'Chờ xác nhận',
    'processing' => 'Đang xử lý',
    'completed' => 'Hoàn thành',
    'cancelled' => 'Đã hủy'
];
?>

<style>
    /* Custom Luxury Styles */
    .bg-soft-warning { background-color: #fff3cd; border: 1px solid #ffeeba; }
    .bg-soft-primary { background-color: #e7f1ff; border: 1px solid #cfe2ff; }
    .bg-soft-success { background-color: #d1e7dd; border: 1px solid #badbcc; }
    .bg-soft-danger { background-color: #f8d7da; border: 1px solid #f5c2c7; }

    .badge-status {
        padding: 0.5em 1em;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }

    .order-table thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: #6c757d;
        padding: 1.2rem 1rem;
        border-top: none;
    }

    .order-id {
        color: #1a1a1a;
        font-family: 'Monaco', 'Consolas', monospace;
        letter-spacing: -0.5px;
    }

    .customer-name {
        font-size: 1rem;
        color: #2d3436;
    }

    .status-select {
        min-width: 140px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .status-select:focus {
        border-color: #000;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
    }

    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    .table tr:hover {
        background-color: #fcfcfc;
    }
    
    .btn-save {
        border-radius: 8px;
        padding: 0.4rem 0.8rem;
        transition: 0.3s;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item small"><a href="index.php?act=admin" class="text-decoration-none text-muted">Hệ thống</a></li>
                    <li class="breadcrumb-item small active">Đơn hàng</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0">Quản lý đơn hàng</h2>
            <p class="text-muted small mb-0">Danh sách các giao dịch và trạng thái vận chuyển thời gian thực.</p>
        </div>
        <a href="index.php?act=admin" class="btn btn-dark shadow-sm px-4 py-2">
            <i class="fa-solid fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <?php if (empty($orders)): ?>
                <div class="p-5 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/10540/10540118.png" width="80" class="opacity-25 mb-3">
                    <p class="text-muted">Hệ thống chưa ghi nhận đơn hàng nào.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 order-table">
                        <thead>
                            <tr>
                                <th class="ps-4">Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Chi tiết</th>
                                <th>Thanh toán</th>
                                <th class="text-center">Trạng thái hiện tại</th>
                                <th class="text-end pe-4">Cập nhật nhanh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="order-id fw-bold text-dark">#<?= (int) $order['id'] ?></span>
                                    </td>
                                    <td>
                                        <div class="customer-name fw-bold mb-0"><?= e($order['user_name'] ?? 'Khách lẻ') ?></div>
                                        <div class="text-muted" style="font-size: 0.8rem;">
                                            <i class="fa-regular fa-clock me-1"></i><?= e(date('d/m/Y H:i', strtotime($order['created_at']))) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-dark fw-medium"><?= (int) $order['total_items'] ?> sản phẩm</div>
                                        <div class="text-danger fw-bold fs-6 mt-1"><?= formatCurrency($order['total_price']) ?></div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if ($order['payment_method'] === 'online'): ?>
                                                <span class="text-primary small"><i class="fa-solid fa-credit-card me-1"></i> Thẻ/E-Wallet</span>
                                            <?php else: ?>
                                                <span class="text-muted small"><i class="fa-solid fa-hand-holding-dollar me-1"></i> Tiền mặt</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-status <?= $statusClasses[$order['status']] ?? 'bg-secondary' ?>">
                                            <?= $statusLabels[$order['status']] ?? $order['status'] ?>
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <form action="index.php?act=update-order-status" method="POST" class="d-flex justify-content-end gap-2">
                                            <input type="hidden" name="order_id" value="<?= (int) $order['id'] ?>">
                                            <select name="status" class="form-select form-select-sm status-select bg-light border-0">
                                                <?php foreach ($statusLabels as $value => $label): ?>
                                                    <option value="<?= $value ?>" <?= $order['status'] === $value ? 'selected' : '' ?>>
                                                        <?= $label ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-dark btn-sm btn-save px-3" title="Lưu thay đổi">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php require './views/layouts/footer.php'; ?>