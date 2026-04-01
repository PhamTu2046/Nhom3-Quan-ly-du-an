<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --admin-bg: #f8fafc;
        --role-admin-bg: #1e293b;
        --role-user-bg: #e0f2fe;
        --role-user-text: #0369a1;
    }

    body { background-color: var(--admin-bg); font-family: 'Inter', sans-serif; }
    
    .page-title { font-weight: 800; color: #0f172a; letter-spacing: -0.02em; }
    
    /* Card & Table */
    .card { border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05) !important; }
    
    .table thead th {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #64748b;
        padding: 1.25rem 1rem;
        border: none;
    }
    
    .table tbody tr { transition: 0.2s; border-bottom: 1px solid #f1f5f9; }
    .table tbody tr:hover { background-color: #fcfcfc; }

    /* User Avatar Circle */
    .avatar-circle {
        width: 38px;
        height: 38px;
        background-color: #e2e8f0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    /* Custom Badges */
    .badge-role {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: capitalize;
    }
    .badge-admin { background-color: var(--role-admin-bg); color: #fff; }
    .badge-user { background-color: var(--role-user-bg); color: var(--role-user-text); }

    .order-count {
        background-color: #f1f5f9;
        color: #1e293b;
        font-weight: 700;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    .btn-dashboard {
        border-radius: 10px;
        font-weight: 600;
        border-color: #e2e8f0;
        color: #64748b;
        transition: 0.3s;
    }
    .btn-dashboard:hover { background-color: #fff; border-color: #1e293b; color: #1e293b; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title mb-1">Quản lý tài khoản</h2>
            <p class="text-muted small mb-0">Phân quyền và theo dõi hoạt động của người dùng trên hệ thống.</p>
        </div>
        <a href="index.php?act=admin" class="btn btn-dashboard bg-white shadow-sm px-4 py-2">
            <i class="fa-solid fa-house-user me-2"></i> Dashboard
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <?php if (empty($users)): ?>
                <div class="p-5 text-center">
                    <div class="mb-3 opacity-25">
                        <i class="fa-solid fa-users-slash fa-4x"></i>
                    </div>
                    <p class="text-muted fw-medium">Hệ thống chưa ghi nhận người dùng nào.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" width="80">ID</th>
                                <th>Thông tin người dùng</th>
                                <th>Liên hệ</th>
                                <th>Vai trò</th>
                                <th class="text-center">Đơn hàng</th>
                                <th class="pe-4">Địa chỉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <?php 
                                    // Tạo tên viết tắt cho Avatar (ví dụ: Nguyen Van A -> NA)
                                    $words = explode(" ", $user['name']);
                                    $initials = (count($words) > 1) ? mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1) : mb_substr($user['name'], 0, 1);
                                ?>
                                <tr>
                                    <td class="ps-4 text-muted small">#<?= (int) $user['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3 shadow-sm border border-white">
                                                <?= e(mb_strtoupper($initials)) ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= e($user['name']) ?></div>
                                                <div class="small text-muted" style="font-size: 0.75rem;">Tham gia: <?= date('d/m/Y') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small fw-medium"><i class="fa-regular fa-envelope me-1 opacity-50"></i><?= e($user['email']) ?></div>
                                        <div class="small text-muted"><i class="fa-solid fa-phone me-1 opacity-50"></i><?= e($user['phone'] ?: 'Chưa cập nhật') ?></div>
                                    </td>
                                    <td>
                                        <span class="badge-role <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                            <i class="fa-solid <?= $user['role'] === 'admin' ? 'fa-shield-halved' : 'fa-user' ?> me-1" style="font-size: 0.7rem;"></i>
                                            <?= e($user['role']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="order-count shadow-sm" title="Tổng số đơn đã đặt">
                                            <?= (int) ($user['order_count'] ?? 0) ?>
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="small text-muted text-truncate" style="max-width: 200px;" title="<?= e($user['address']) ?>">
                                            <i class="fa-solid fa-location-dot me-1 opacity-50"></i>
                                            <?= e($user['address'] ?: 'N/A') ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <small class="text-muted">Tổng cộng <strong><?= count($users) ?></strong> tài khoản</small>
            <div class="small text-muted italic"><i class="fa-solid fa-circle-info me-1"></i> Dữ liệu được bảo mật bởi hệ thống.</div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php require './views/admin/layouts/footer.php'; ?>