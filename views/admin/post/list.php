<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --primary-dark: #1e293b;
        --accent-gold: #c5a059;
    }

    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }

    /* Header & Action Button */
    .page-title { font-weight: 800; color: #0f172a; letter-spacing: -0.02em; }
    .btn-add { 
        background-color: var(--primary-dark); 
        color: white; 
        border-radius: 10px; 
        padding: 10px 20px; 
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-add:hover { background-color: #000; transform: translateY(-2px); color: white; }

    /* Table Styling */
    .card { border-radius: 16px; overflow: hidden; }
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
    .post-thumb {
        width: 80px;
        height: 54px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    /* Typography */
    .post-title { 
        color: #1e293b; 
        font-size: 0.95rem; 
        font-weight: 600; 
        display: block;
        margin-bottom: 2px;
    }
    .post-excerpt { 
        font-size: 0.85rem; 
        color: #94a3b8; 
        max-width: 350px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Action Buttons */
    .btn-action {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: 0.2s;
        border: none;
    }
    .btn-edit { background-color: #fef9c3; color: #a16207; }
    .btn-edit:hover { background-color: #fde047; }
    .btn-delete { background-color: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background-color: #fecaca; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title mb-1">Quản lý bài viết</h2>
            <p class="text-muted small mb-0">Chỉnh sửa nội dung tin tức và bài viết trên website.</p>
        </div>
        <a href="index.php?act=add-post" class="btn btn-add shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Soạn bài viết mới
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <?php if (empty($posts)): ?>
                <div class="p-5 text-center">
                    <div class="mb-3 text-muted opacity-25">
                        <i class="fa-solid fa-pen-nib fa-4x"></i>
                    </div>
                    <h5 class="text-muted fw-normal">Chưa có bài viết nào trong hệ thống.</h5>
                    <a href="index.php?act=add-post" class="btn btn-link text-decoration-none small">Bắt đầu viết ngay</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" width="80">ID</th>
                                <th width="120">Hình ảnh</th>
                                <th>Nội dung bài viết</th>
                                <th width="180">Ngày đăng</th>
                                <th class="text-center pe-4" width="120">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post): ?>
                                <?php
                                    $image = !empty($post['image']) ? 'uploads/' . basename($post['image']) : 'https://placehold.co/120x80?text=No+Image';
                                    $excerpt = $post['content'] ?? 'Chưa có nội dung mô tả...';
                                ?>
                                <tr>
                                    <td class="ps-4 text-muted small fw-medium">#<?= (int) $post['id'] ?></td>
                                    <td>
                                        <img src="<?= e($image) ?>" alt="<?= e($post['title']) ?>" class="post-thumb">
                                    </td>
                                    <td>
                                        <span class="post-title"><?= e($post['title']) ?></span>
                                        <div class="post-excerpt"><?= e(strip_tags($excerpt)) ?></div>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold text-dark">
                                            <i class="fa-regular fa-calendar-check me-1 text-muted"></i>
                                            <?= !empty($post['created_at']) ? e(date('d/m/Y', strtotime($post['created_at']))) : 'N/A' ?>
                                        </div>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            <?= !empty($post['created_at']) ? e(date('H:i', strtotime($post['created_at']))) : '' ?>
                                        </div>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="index.php?act=edit-post&id=<?= (int) $post['id'] ?>" 
                                               class="btn-action btn-edit" title="Sửa bài viết">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="index.php?act=delete-post&id=<?= (int) $post['id'] ?>" 
                                               class="btn-action btn-delete" 
                                               onclick="return confirm('Hành động xóa không thể khôi phục. Bạn chắc chắn chứ?')" 
                                               title="Xóa bài viết">
                                                <i class="fa-solid fa-trash-can"></i>
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
        <div class="card-footer bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small">Hiển thị <strong><?= count($posts) ?></strong> bài viết</span>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php require './views/admin/layouts/footer.php'; ?>