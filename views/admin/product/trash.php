<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --admin-bg: #f8fafc;
        --danger-soft: #fff1f2;
        --danger-text: #e11d48;
        --success-soft: #f0fdf4;
        --success-text: #16a34a;
    }

    body { background-color: var(--admin-bg); font-family: 'Inter', sans-serif; }
    
    .page-title { font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
    
    /* Table Styling */
    .card { border-radius: 16px; border: none; overflow: hidden; background: white; }
    .table thead th {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #64748b;
        padding: 1.25rem 1rem;
        border: none;
    }
    .table tbody tr { transition: 0.2s; border-bottom: 1px solid #f1f5f9; }
    .table tbody tr:hover { background-color: #fffafb; } /* Hiệu ứng hồng nhạt khi hover vào món đã xóa */
    
    /* Thumbnail */
    .trash-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
        filter: grayscale(60%); /* Làm mờ màu sắc để ám chỉ đồ cũ/xóa */
        opacity: 0.8;
    }

    /* Action Buttons */
    .btn-restore {
        background-color: var(--success-soft);
        color: var(--success-text);
        border: 1px solid #dcfce7;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: 0.3s;
    }
    .btn-restore:hover { background-color: #dcfce7; color: #15803d; transform: translateY(-2px); }

    .btn-force-delete {
        background-color: var(--danger-soft);
        color: var(--danger-text);
        border: 1px solid #ffe4e6;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: 0.3s;
    }
    .btn-force-delete:hover { background-color: #ffe4e6; color: #be123c; transform: translateY(-2px); }

    .btn-back {
        border-radius: 10px;
        font-weight: 600;
        color: #64748b;
        background: white;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">Thùng rác</h2>
            <p class="text-muted small mb-0">Nơi lưu trữ tạm thời các món ăn đã được yêu cầu xóa.</p>
        </div>
        <a href="index.php?act=list-product" class="btn btn-back px-4 py-2 shadow-sm">
            <i class="fa-solid fa-chevron-left me-2"></i> Quay lại danh sách
        </a>
    </div>

    <?php if (empty($products)): ?>
        <div class="card shadow-sm border-0">
            <div class="card-body p-5 text-center">
                <div class="mb-3 text-muted opacity-25">
                    <i class="fa-solid fa-trash-can-arrow-up fa-4x"></i>
                </div>
                <h5 class="text-muted fw-normal">Thùng rác hiện đang trống.</h5>
                <p class="small text-muted">Các món ăn bạn xóa sẽ xuất hiện tại đây.</p>
            </div>
        </div>
    <?php else: ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" width="80">ID</th>
                            <th width="100">Ảnh</th>
                            <th>Tên món ăn</th>
                            <th>Giá gốc</th>
                            <th>Danh mục</th>
                            <th class="text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $item): ?>
                            <tr>
                                <td class="ps-4 text-muted small">#<?= $item['id'] ?></td>
                                <td>
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="uploads/<?= e($item['image']) ?>" class="trash-thumb shadow-sm">
                                    <?php else: ?>
                                        <div class="trash-thumb bg-light d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-image text-muted opacity-25"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark opacity-75"><?= e($item['name']) ?></div>
                                    <div class="text-muted small italic">Chờ xử lý xóa vĩnh viễn</div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-secondary small"><?= number_format($item['price']) ?> đ</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted border px-2 py-1"><?= e($item['category_name'] ?? 'Không có') ?></span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="index.php?act=restore-product&id=<?= $item['id'] ?>"
                                           class="btn btn-restore btn-sm"
                                           onclick="return confirm('Khôi phục món này về thực đơn chính?')">
                                            <i class="fa-solid fa-rotate-left me-1"></i> Khôi phục
                                        </a>

                                        <a href="index.php?act=force-delete-product&id=<?= $item['id'] ?>"
                                           class="btn btn-force-delete btn-sm"
                                           onclick="return confirm('CẢNH BÁO: Hành động xóa vĩnh viễn không thể hoàn tác. Bạn chắc chắn chứ?')">
                                            <i class="fa-solid fa-fire-burner me-1"></i> Xóa hẳn
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3 border-0">
            <small class="text-danger ps-2"><i class="fa-solid fa-circle-exclamation me-1"></i> Lưu ý: Dữ liệu xóa vĩnh viễn sẽ biến mất hoàn toàn khỏi máy chủ.</small>
        </div>
    </div>

    <?php endif; ?>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php require './views/admin/layouts/footer.php'; ?>