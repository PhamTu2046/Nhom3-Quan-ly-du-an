<?php require './views/admin/layouts/header.php'; ?>

<?php
$statusClasses = [
    'pending' => 'bg-soft-warning text-warning',
    'processing' => 'bg-soft-primary text-primary',
    'completed' => 'bg-soft-success text-success',
    'cancelled' => 'bg-soft-danger text-danger',
];
$statusLabels = orderStatusLabels();
$statusDescriptions = orderStatusDescriptions('admin');
$cancelReasonLabels = orderCancelReasonLabels();
?>

<style>
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

    .customer-meta {
        color: #6b7280;
        font-size: 0.82rem;
        line-height: 1.5;
    }

    .status-select {
        min-width: 300px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .status-select:focus {
        border-color: #000;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
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

    .status-current-note {
        color: #6b7280;
        font-size: 0.76rem;
        line-height: 1.45;
        max-width: 260px;
        margin: 0.55rem auto 0;
    }

    .status-update-form {
        flex-wrap: wrap;
    }

    .order-detail-summary {
        min-width: 320px;
    }

    .order-items-stack {
        display: grid;
        gap: 10px;
        margin-top: 0.9rem;
    }

    .order-item-row {
        display: grid;
        grid-template-columns: 48px 1fr auto;
        gap: 12px;
        align-items: center;
        padding: 10px 12px;
        border: 1px solid #edf1f5;
        border-radius: 12px;
        background: #fff;
    }

    .order-item-thumb {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        overflow: hidden;
        background: #f5f5f5;
        border: 1px solid #ececec;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .order-item-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .order-item-name {
        color: #1f2937;
        font-weight: 700;
        line-height: 1.35;
    }

    .order-item-meta {
        color: #6b7280;
        font-size: 0.78rem;
    }

    .order-item-total {
        color: #dc2626;
        font-size: 0.88rem;
        font-weight: 700;
        text-align: right;
        white-space: nowrap;
    }

    .order-meta-chip {
        margin-top: 0.65rem;
        padding: 10px 12px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #edf1f5;
        color: #475569;
        font-size: 0.8rem;
        line-height: 1.45;
    }

    .order-meta-chip strong {
        color: #0f172a;
    }

    @media (max-width: 991.98px) {
        .order-item-row {
            grid-template-columns: 40px 1fr;
        }

        .order-item-total {
            text-align: left;
        }

        .status-select {
            min-width: 220px;
        }
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
            <p class="text-muted small mb-0">Danh sách giao dịch, món ăn, thông tin nhận hàng và lý do hủy để bếp và vận hành theo dõi.</p>
        </div>
        <a href="index.php?act=admin" class="btn btn-dark shadow-sm px-4 py-2">
            <i class="fa-solid fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <?php if (empty($orders)): ?>
                <div class="p-5 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/10540/10540118.png" width="80" class="opacity-25 mb-3" alt="No orders">
                    <p class="text-muted">Hệ thống chưa ghi nhận đơn hàng nào.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 order-table">
                        <thead>
                            <tr>
                                <th class="ps-4">Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Chi tiết món</th>
                                <th>Thanh toán</th>
                                <th class="text-center">Trạng thái hiện tại</th>
                                <th class="text-end pe-4">Cập nhật nhanh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <?php $cancelReasonLabel = $cancelReasonLabels[$order['cancel_reason'] ?? ''] ?? null; ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="order-id fw-bold text-dark">#<?= (int) $order['id'] ?></span>
                                    </td>
                                    <td>
                                        <div class="customer-name fw-bold mb-1"><?= e($order['user_name'] ?? 'Khách lẻ') ?></div>
                                        <div class="customer-meta">
                                            <i class="fa-regular fa-clock me-1"></i><?= e(date('d/m/Y H:i', strtotime($order['created_at']))) ?>
                                        </div>
                                        <?php if (!empty($order['contact_phone'])): ?>
                                            <div class="customer-meta">
                                                <i class="fa-solid fa-phone me-1"></i><?= e($order['contact_phone']) ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($order['user_email'])): ?>
                                            <div class="customer-meta">
                                                <i class="fa-regular fa-envelope me-1"></i><?= e($order['user_email']) ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($order['delivery_address'])): ?>
                                            <div class="customer-meta">
                                                <i class="fa-solid fa-location-dot me-1"></i><?= e($order['delivery_address']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="order-detail-summary">
                                            <div class="small text-dark fw-medium"><?= (int) $order['total_items'] ?> sản phẩm</div>
                                            <div class="text-danger fw-bold fs-6 mt-1"><?= formatCurrency($order['total_price']) ?></div>

                                            <?php if (empty($order['items'] ?? [])): ?>
                                                <div class="order-meta-chip">Chưa có chi tiết món ăn.</div>
                                            <?php else: ?>
                                                <div class="order-items-stack">
                                                    <?php foreach (($order['items'] ?? []) as $item): ?>
                                                        <?php
                                                        $itemImage = !empty($item['product_image'])
                                                            ? 'uploads/' . basename($item['product_image'])
                                                            : 'https://placehold.co/80x80/e5e7eb/6b7280?text=Food';
                                                        $itemName = $item['product_name'] ?? 'Món ăn không còn trong hệ thống';
                                                        $itemCategory = $item['category_name'] ?? 'Không rõ danh mục';
                                                        $itemQuantity = (int) ($item['quantity'] ?? 0);
                                                        $itemPrice = (float) ($item['price'] ?? 0);
                                                        ?>
                                                        <div class="order-item-row">
                                                            <div class="order-item-thumb">
                                                                <img src="<?= e($itemImage) ?>" alt="<?= e($itemName) ?>">
                                                            </div>
                                                            <div>
                                                                <div class="order-item-name"><?= e($itemName) ?></div>
                                                                <div class="order-item-meta">
                                                                    <?= e($itemCategory) ?> | SL: <?= $itemQuantity ?> | Đơn giá: <?= formatCurrency($itemPrice) ?>
                                                                </div>
                                                            </div>
                                                            <div class="order-item-total"><?= formatCurrency($itemPrice * $itemQuantity) ?></div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($cancelReasonLabel !== null): ?>
                                                <div class="order-meta-chip">
                                                    <strong>Lý do hủy:</strong> <?= e($cancelReasonLabel) ?>
                                                    <?php if (!empty($order['cancel_note'])): ?>
                                                        <div class="mt-1"><?= e($order['cancel_note']) ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if (($order['payment_method'] ?? 'cod') === 'online'): ?>
                                                <span class="text-primary small"><i class="fa-solid fa-credit-card me-1"></i> Thẻ/E-Wallet</span>
                                            <?php else: ?>
                                                <span class="text-muted small"><i class="fa-solid fa-hand-holding-dollar me-1"></i> Tiền mặt</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-status <?= $statusClasses[$order['status']] ?? 'bg-secondary' ?>">
                                            <?= e($statusLabels[$order['status']] ?? $order['status']) ?>
                                        </span>
                                        <div class="status-current-note">
                                            <?= e($statusDescriptions[$order['status']] ?? 'Trạng thái hiện tại của đơn hàng.') ?>
                                        </div>
                                    </td>
                                    <td class="pe-4">
                                        <form action="index.php?act=update-order-status" method="POST" class="d-flex justify-content-end gap-2 status-update-form">
                                            <input type="hidden" name="order_id" value="<?= (int) $order['id'] ?>">
                                            <select name="status" class="form-select form-select-sm status-select bg-light border-0">
                                                <?php foreach ($statusLabels as $value => $label): ?>
                                                    <option value="<?= e($value) ?>" <?= ($order['status'] ?? '') === $value ? 'selected' : '' ?>>
                                                        <?= e($label) ?>
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

<?php require './views/admin/layouts/footer.php'; ?>
