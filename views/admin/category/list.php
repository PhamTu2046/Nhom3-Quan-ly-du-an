<?php require './views/layouts/header.php'; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.95);
        --primary-dark: #1a1a1a;
        --accent-color: #c5a059; /* Màu vàng đồng nhẹ tạo cảm giác sang trọng */
    }

    body {
        background-color: #f4f7f6;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .form-control, .btn {
        border-radius: 10px;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.2);
        border-color: var(--accent-color);
    }

    .table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #64748b;
        border-top: none;
        padding: 1.25rem 1rem;
    }

    .category-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.95rem;
    }

    .btn-dark {
        background-color: var(--primary-dark);
        border: none;
    }

    .btn-dark:hover {
        background-color: #333;
        transform: translateY(-1px);
    }

    .badge-luxury {
        background-color: #e2e8f0;
        color: #475569;
        font-weight: 500;
        padding: 0.5em 1em;
    }

    /* Hiệu ứng hover cho dòng trong bảng */
    .table tbody tr:hover {
        background-color: #fbfbfb;
    }
</style>

<div class="container-fluid py-5">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box bg-dark text-white rounded-3 p-2 me-3">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h5 class="mb-0 fw-bold"><?= $editingCategory ? 'Chỉnh sửa danh mục' : 'Thêm danh mục mới' ?></h5>
                    </div>

                    <form action="index.php?act=save-category" method="POST">
                        <input type="hidden" name="id" value="<?= (int) ($editingCategory['id'] ?? 0) ?>">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">TÊN DANH MỤC</label>
                            <input type="text" name="name" class="form-control bg-light border-0" 
                                   placeholder="VD: Món Khai Vị, Tráng Miệng..."
                                   value="<?= e($editingCategory['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-muted">MÔ TẢ NGẮN</label>
                            <textarea name="description" class="form-control bg-light border-0" rows="4" 
                                      placeholder="Mô tả sẽ hiển thị nhẹ nhàng bên dưới tên danh mục..."><?= e($editingCategory['description'] ?? '') ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark py-3 fw-bold shadow-sm">
                                <?= $editingCategory ? '<i class="fa-solid fa-save me-2"></i> Lưu thay đổi' : '<i class="fa-solid fa-plus me-2"></i> Tạo danh mục' ?>
                            </button>
                            <?php if ($editingCategory): ?>
                                <a href="index.php?act=admin-categories" class="btn btn-outline-secondary py-2 border-0">Hủy bỏ</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="px-4 py-4 d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">Danh sách danh mục</h4>
                            <p class="text-muted small mb-0">Hệ thống phân loại thực đơn hiện tại của nhà hàng</p>
                        </div>
                        <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                            <i class="fa-solid fa-tag me-1 text-muted"></i> <?= count($categories) ?> mục
                        </span>
                    </div>

                    <?php if (empty($categories)): ?>
                        <div class="py-5 text-center">
                            <i class="fa-solid fa-inbox fa-3x text-light mb-3"></i>
                            <p class="text-muted">Chưa có dữ liệu nào được ghi nhận.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4" width="80">ID</th>
                                        <th>Thông tin danh mục</th>
                                        <th width="150">Số món</th>
                                        <th class="text-end pe-4" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td class="ps-4 text-muted small">#<?= (int) $category['id'] ?></td>
                                            <td>
                                                <div class="category-name mb-1"><?= e($category['name']) ?></div>
                                                <div class="text-muted small" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    <?= e($category['description'] ?: 'Chưa cập nhật mô tả cho mục này.') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded-pill badge-luxury">
                                                    <i class="fa-solid fa-utensils me-1" style="font-size: 10px;"></i>
                                                    <?= (int) ($category['product_count'] ?? 0) ?> món
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group shadow-sm rounded-3">
                                                    <a href="index.php?act=admin-categories&id=<?= (int) $category['id'] ?>" 
                                                       class="btn btn-white btn-sm px-3 border-end" title="Sửa">
                                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                                    </a>
                                                    <a href="index.php?act=delete-category&id=<?= (int) $category['id'] ?>" 
                                                       class="btn btn-white btn-sm px-3" 
                                                       onclick="return confirm('Hệ thống sẽ xóa vĩnh viễn danh mục này. Bạn chắc chắn chứ?')" title="Xóa">
                                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                                    </a>
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
            <div class="mt-3 text-center">
                <p class="text-muted small italic">Mẹo: Danh mục có nhiều món ăn sẽ được ưu tiên hiển thị trên trang chủ.</p>
            </div>
        </div>
    </div>
</div>

<?php require './views/layouts/footer.php'; ?>