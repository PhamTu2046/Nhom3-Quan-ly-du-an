<?php require './views/client/layouts/header.php'; ?>
<?php
$statusClasses = [
    'pending' => 'order-pending',
    'processing' => 'order-processing',
    'completed' => 'order-completed',
    'cancelled' => 'order-cancelled',
];
$statusLabels = orderStatusLabels();
$statusDescriptions = orderStatusDescriptions('customer');
$cancelReasonLabels = orderCancelReasonLabels();
?>

<style>
    :root {
        --lux-gold: #d4af37;
        --lux-gold-light: #f1d38a;
        --glass-dark: rgba(10, 10, 10, 0.85);
        --border-gold: rgba(212, 175, 55, 0.25);
        --soft-white: rgba(255, 255, 255, 0.72);
    }

    body {
        background-color: #000 !important;
        color: #fff !important;
    }

    .master-bg {
        position: fixed;
        inset: 0;
        background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=2070');
        background-size: cover;
        background-position: center;
        filter: brightness(0.2) blur(5px);
        z-index: -1;
    }

    .lux-header-title {
        font-family: Arial, Helvetica, sans-serif;
        color: var(--lux-gold);
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .order-vault-card {
        background: var(--glass-dark) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--border-gold) !important;
        border-radius: 0 !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    }

    .table {
        color: rgba(255, 255, 255, 0.8) !important;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .table thead th {
        font-family: Arial, Helvetica, sans-serif;
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
    }

    .table tbody td {
        padding: 20px !important;
        border: none !important;
        border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        vertical-align: top;
    }

    .order-summary-row:hover {
        background: rgba(212, 175, 55, 0.05);
    }

    .order-detail-row {
        background: transparent !important;
    }

    .order-detail-row td {
        padding-top: 0 !important;
        border-top: none !important;
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
    .order-cancelled { color: #dc3545; opacity: 0.85; }

    .btn-lux-outline {
        border: 1px solid var(--lux-gold);
        color: var(--lux-gold);
        border-radius: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.7rem;
        letter-spacing: 1px;
        transition: 0.4s;
        background: transparent;
    }

    .btn-lux-outline:hover {
        background: var(--lux-gold);
        color: #000;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
    }

    .order-status-actions {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    .order-status-note {
        max-width: 250px;
        color: rgba(255, 255, 255, 0.58);
        font-size: 0.76rem;
        line-height: 1.45;
    }

    .cancel-order-box {
        width: 100%;
        max-width: 280px;
    }

    .cancel-order-box summary {
        list-style: none;
        cursor: pointer;
        text-align: center;
        padding: 9px 14px;
        border: 1px solid rgba(220, 53, 69, 0.75);
        background: rgba(255, 240, 242, 0.92);
        color: #c62839;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        user-select: none;
        box-shadow: 0 10px 22px rgba(220, 53, 69, 0.08);
    }

    .cancel-order-box summary::-webkit-details-marker {
        display: none;
    }

    .cancel-order-box[open] summary {
        margin-bottom: 10px;
        background: #ffe4e8;
        color: #b71c2b;
    }

    .cancel-order-form {
        text-align: left;
        padding: 16px;
        border: 1px solid rgba(220, 53, 69, 0.22);
        background: linear-gradient(180deg, rgba(255, 251, 252, 0.98) 0%, rgba(255, 244, 246, 0.95) 100%);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
    }

    .cancel-order-label {
        display: block;
        color: #7f1d1d;
        font-size: 0.73rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .cancel-order-form .form-select,
    .cancel-order-form .form-control {
        border-radius: 0;
        background: #fff;
        border: 1px solid rgba(220, 53, 69, 0.24);
        color: #1f2937;
        box-shadow: none;
        min-height: 42px;
    }

    .cancel-order-form .form-select option {
        color: #000;
    }

    .cancel-order-form .form-select:focus,
    .cancel-order-form .form-control:focus {
        border-color: rgba(220, 53, 69, 0.65);
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.12);
    }

    .cancel-order-form .form-control::placeholder {
        color: #9ca3af;
        opacity: 1;
    }

    .cancel-order-help {
        color: #6b7280;
        font-size: 0.73rem;
        line-height: 1.4;
    }

    .btn-cancel-submit {
        width: 100%;
        margin-top: 10px;
        border-color: #dc3545;
        color: #fff;
        background: #dc3545;
    }

    .btn-cancel-submit:hover {
        background: transparent;
        color: #ff98a1;
        border-color: #ff98a1;
    }

    .order-detail-panel {
        border: 1px solid rgba(212, 175, 55, 0.16);
        background: rgba(255, 255, 255, 0.02);
        padding: 18px;
    }

    .order-section-title {
        color: var(--lux-gold-light);
        font-family: Arial, Helvetica, sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        font-size: 0.74rem;
        margin-bottom: 12px;
    }

    .order-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .order-meta-card {
        padding: 14px 16px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(0, 0, 0, 0.22);
    }

    .order-meta-card.order-meta-danger {
        border-color: rgba(220, 53, 69, 0.28);
        background: rgba(220, 53, 69, 0.08);
    }

    .order-meta-label {
        color: rgba(255, 255, 255, 0.45);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.68rem;
        margin-bottom: 6px;
    }

    .order-meta-value {
        color: #fff;
        font-weight: 600;
        line-height: 1.45;
    }

    .order-meta-note {
        color: rgba(255, 255, 255, 0.55);
        font-size: 0.78rem;
        margin-top: 6px;
        line-height: 1.45;
    }

    .order-items-list {
        display: grid;
        gap: 12px;
    }

    .order-item-card {
        display: grid;
        grid-template-columns: 70px minmax(180px, 1.7fr) minmax(90px, 0.7fr) minmax(120px, 0.8fr) minmax(140px, 0.9fr);
        gap: 14px;
        align-items: center;
        padding: 12px 14px;
        background: rgba(0, 0, 0, 0.25);
        border-left: 2px solid rgba(212, 175, 55, 0.6);
    }

    .order-item-thumb {
        width: 70px;
        height: 70px;
        border: 1px solid rgba(212, 175, 55, 0.25);
        overflow: hidden;
        background: rgba(255, 255, 255, 0.03);
    }

    .order-item-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .order-item-name {
        color: #fff;
        font-weight: 700;
        line-height: 1.35;
    }

    .order-item-meta {
        color: rgba(255, 255, 255, 0.55);
        font-size: 0.82rem;
    }

    .order-item-stat {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .order-item-stat-label {
        color: rgba(255, 255, 255, 0.45);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.68rem;
    }

    .order-item-stat-value {
        color: #f5f5f5;
        font-weight: 600;
    }

    .order-item-total {
        color: var(--lux-gold);
        font-weight: 700;
        font-size: 1rem;
    }

    @media (max-width: 1199.98px) {
        .order-meta-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 991.98px) {
        .order-item-card {
            grid-template-columns: 60px 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .order-meta-grid {
            grid-template-columns: 1fr;
        }

        .order-item-card {
            grid-template-columns: 56px 1fr;
            padding: 12px;
        }

        .order-status-note,
        .cancel-order-box {
            max-width: none;
        }
    }
</style>

<div class="master-bg"></div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate__animated animate__fadeIn flex-wrap gap-3">
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
                                <?php
                                $orderItems = $order['items'] ?? [];
                                $cancelReasonLabel = $cancelReasonLabels[$order['cancel_reason'] ?? ''] ?? null;
                                $paymentLabel = ($order['payment_method'] ?? 'cod') === 'online' ? 'Online' : 'Tiền mặt';
                                ?>
                                <tr class="order-summary-row">
                                    <td><span class="order-id">#<?= (int) $order['id'] ?></span></td>
                                    <td>
                                        <div class="small"><?= e(date('d/m/Y', strtotime($order['created_at']))) ?></div>
                                        <div class="text-muted x-small"><?= e(date('H:i', strtotime($order['created_at']))) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge border border-secondary text-secondary"><?= (int) $order['total_items'] ?> món</span>
                                    </td>
                                    <td>
                                        <i class="fa-solid <?= ($order['payment_method'] ?? 'cod') === 'online' ? 'fa-credit-card' : 'fa-hand-holding-dollar' ?> me-2 small"></i>
                                        <?= e($paymentLabel) ?>
                                    </td>
                                    <td><span class="price-total"><?= formatCurrency($order['total_price']) ?></span></td>
                                    <td class="text-center">
                                        <div class="order-status-actions">
                                            <span class="badge-elite <?= $statusClasses[$order['status']] ?? 'text-secondary' ?>">
                                                <i class="fa-solid fa-circle-dot me-1 small"></i>
                                                <?= e($statusLabels[$order['status']] ?? $order['status']) ?>
                                            </span>
                                            <div class="order-status-note">
                                                <?= e($statusDescriptions[$order['status']] ?? 'Đơn hàng của bạn đang được cập nhật trạng thái.') ?>
                                            </div>

                                            <?php if (($order['status'] ?? '') === 'pending'): ?>
                                                <details class="cancel-order-box">
                                                    <summary>Hủy đơn</summary>
                                                    <form action="index.php?act=cancel-order" method="POST" class="cancel-order-form">
                                                        <input type="hidden" name="order_id" value="<?= (int) $order['id'] ?>">

                                                        <label class="cancel-order-label" for="cancel_reason_<?= (int) $order['id'] ?>">Lý do hủy đơn</label>
                                                        <select id="cancel_reason_<?= (int) $order['id'] ?>" name="cancel_reason" class="form-select form-select-sm mb-3" required>
                                                            <option value="">Chọn lý do bạn muốn hủy</option>
                                                            <?php foreach ($cancelReasonLabels as $reasonValue => $reasonLabel): ?>
                                                                <option value="<?= e($reasonValue) ?>"><?= e($reasonLabel) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                        <label class="cancel-order-label" for="cancel_note_<?= (int) $order['id'] ?>">Ghi chú thêm</label>
                                                        <textarea
                                                            id="cancel_note_<?= (int) $order['id'] ?>"
                                                            name="cancel_note"
                                                            rows="3"
                                                            class="form-control form-control-sm"
                                                            placeholder="Ví dụ: Muốn đổi sang Burger Gà hoặc muốn áp dụng mã giảm giá."
                                                        ></textarea>

                                                        <div class="cancel-order-help mt-2">
                                                            Nếu chọn "Lý do khác", hãy nhập thêm ghi chú cụ thể để cửa hàng xử lý đúng cho bạn.
                                                        </div>

                                                        <button
                                                            type="submit"
                                                            class="btn btn-lux-outline btn-cancel-submit"
                                                            onclick="return confirm('Xác nhận hủy đơn hàng này?');"
                                                        >
                                                            Xác nhận hủy đơn
                                                        </button>
                                                    </form>
                                                </details>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="order-detail-row">
                                    <td colspan="6">
                                        <div class="order-detail-panel">
                                            <div class="order-section-title">
                                                <i class="fa-solid fa-user-check me-2"></i>Thông tin nhận hàng
                                            </div>
                                            <div class="order-meta-grid">
                                                <div class="order-meta-card">
                                                    <div class="order-meta-label">Số điện thoại nhận</div>
                                                    <div class="order-meta-value"><?= e($order['contact_phone'] ?: 'Chưa cập nhật') ?></div>
                                                </div>
                                                <div class="order-meta-card">
                                                    <div class="order-meta-label">Địa chỉ nhận hàng</div>
                                                    <div class="order-meta-value"><?= e($order['delivery_address'] ?: 'Chưa cập nhật địa chỉ nhận hàng') ?></div>
                                                </div>
                                                <div class="order-meta-card">
                                                    <div class="order-meta-label">Phương thức thanh toán</div>
                                                    <div class="order-meta-value"><?= e($paymentLabel) ?></div>
                                                </div>
                                                <?php if (($order['status'] ?? '') === 'cancelled' && $cancelReasonLabel !== null): ?>
                                                    <div class="order-meta-card order-meta-danger">
                                                        <div class="order-meta-label">Lý do hủy đơn</div>
                                                        <div class="order-meta-value"><?= e($cancelReasonLabel) ?></div>
                                                        <?php if (!empty($order['cancel_note'])): ?>
                                                            <div class="order-meta-note"><?= e($order['cancel_note']) ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                                <div class="order-section-title mb-0">
                                                    <i class="fa-solid fa-utensils me-2"></i>Chi tiết món trong đơn
                                                </div>
                                                <div class="small text-secondary"><?= (int) $order['total_items'] ?> phần đã đặt</div>
                                            </div>

                                            <?php if (empty($orderItems)): ?>
                                                <div class="small text-secondary">Đơn hàng này chưa có dữ liệu món ăn để hiển thị.</div>
                                            <?php else: ?>
                                                <div class="order-items-list">
                                                    <?php foreach ($orderItems as $item): ?>
                                                        <?php
                                                        $itemImage = !empty($item['product_image'])
                                                            ? 'uploads/' . basename($item['product_image'])
                                                            : 'https://placehold.co/120x120/111/D4AF37?text=Food';
                                                        $itemName = $item['product_name'] ?? 'Món ăn không còn trong hệ thống';
                                                        $itemCategory = $item['category_name'] ?? 'Không rõ danh mục';
                                                        $itemQuantity = (int) ($item['quantity'] ?? 0);
                                                        $itemPrice = (float) ($item['price'] ?? 0);
                                                        ?>
                                                        <div class="order-item-card">
                                                            <div class="order-item-thumb">
                                                                <img src="<?= e($itemImage) ?>" alt="<?= e($itemName) ?>">
                                                            </div>
                                                            <div>
                                                                <div class="order-item-name"><?= e($itemName) ?></div>
                                                                <div class="order-item-meta"><?= e($itemCategory) ?></div>
                                                            </div>
                                                            <div class="order-item-stat">
                                                                <span class="order-item-stat-label">Số lượng</span>
                                                                <span class="order-item-stat-value"><?= $itemQuantity ?></span>
                                                            </div>
                                                            <div class="order-item-stat">
                                                                <span class="order-item-stat-label">Đơn giá</span>
                                                                <span class="order-item-stat-value"><?= formatCurrency($itemPrice) ?></span>
                                                            </div>
                                                            <div class="order-item-stat">
                                                                <span class="order-item-stat-label">Thành tiền</span>
                                                                <span class="order-item-total"><?= formatCurrency($itemPrice * $itemQuantity) ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
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
