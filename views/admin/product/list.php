<?php require './views/layouts/header.php'; ?>

<style>
    :root {
        --admin-dark: #1e293b;
        --admin-bg: #f8fafc;
    }

    body { background-color: var(--admin-bg); font-family: 'Inter', sans-serif; }
    
    .page-title { font-weight: 800; color: #0f172a; letter-spacing: -0.02em; }
    
    /* Card & Table */
    .card { border-radius: 16px; border: none; overflow: hidden; }
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
    .table tbody tr:hover { background-color: #fcfcfc; }
    
    /* Thumbnail */
    .product-img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        border: 2px solid #fff;
    }

    /* Action Buttons */
    .btn-action {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: 0.2s;
        border: none;
    }
    .btn-edit { background-color: #fef9c3; color: #a16207; }
    .btn-edit:hover { background-color: #fde047; transform: translateY(-2px); }
    .btn-del { background-color: #fee2e2; color: #b91c1c; }
    .btn-del:hover { background-color: #fecaca; transform: translateY(-2px); }

    /* Badges */
    .badge-category {
        background-color: #e0f2fe;
        color: #0369a1;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
    }
    
    .price-text { font-weight: 700; color: #1e293b; font-size: 0.95rem; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title mb-1">Danh sách món ăn</h2>
            <p class="text-muted small mb-0">Quản lý thực đơn và điều chỉnh giá bán sản phẩm.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="index.php?act=trash-product" class="btn btn-outline-danger px-3 py-2 rounded-3 border-0">
                <i class="fa-solid fa-trash-can me-1"></i> Thùng rác
            </a>
            <a href="index.php?act=add-product" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Thêm món mới
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Món ăn</th>
                            <th>Danh mục</th>
                            <th>Giá bán</th>
                            <th class="text-center pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-utensils fa-2x mb-3 opacity-25"></i>
                                    <p>Không tìm thấy món ăn nào trong thực đơn.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td class="ps-4 text-muted small">#<?= $product['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <?php if (!empty($product['image'])): ?>
                                                    <img src="uploads/<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>" class="product-img">
                                                <?php else: ?>
                                                    <div class="product-img bg-light d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-image text-muted opacity-25"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= e($product['name']) ?></div>
                                                <div class="small text-muted italic">ID nội bộ: <?= $product['id'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-category"><?= e($product['category_name']) ?></span>
                                    </td>
                                    <td>
                                        <span class="price-text text-danger"><?= number_format($product['price']) ?> đ</span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="index.php?act=edit-product&id=<?= $product['id'] ?>" 
                                               class="btn-action btn-edit" title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="index.php?act=delete-product&id=<?= $product['id'] ?>"
                                               onclick="return confirm('Món ăn này sẽ được chuyển vào thùng rác. Tiếp tục?')"
                                               class="btn-action btn-del" title="Xóa">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            <small class="text-muted ps-2">Tổng số món ăn: <strong><?= count($products) ?></strong></small>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php require './views/layouts/footer.php'; ?>