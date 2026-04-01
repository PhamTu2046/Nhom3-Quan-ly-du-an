<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --glass-bg: #ffffff;
        --primary-dark: #1e293b;
        --accent-gold: #c5a059;
    }

    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }

    /* Card & Layout */
    .card { border: none; border-radius: 20px; transition: 0.3s; }
    .page-header { border-bottom: 1px solid #e2e8f0; padding-bottom: 1.5rem; }
    
    /* Input Styling */
    .form-label { font-weight: 600; font-size: 0.85rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-control { 
        border-radius: 12px; 
        padding: 0.8rem 1.2rem; 
        background-color: #f1f5f9; 
        border: 2px solid transparent; 
        transition: 0.2s;
    }
    .form-control:focus { 
        background-color: #fff; 
        border-color: var(--primary-dark); 
        box-shadow: 0 0 0 4px rgba(30, 41, 59, 0.05); 
    }

    /* Post Title Specific */
    .title-input {
        font-size: 1.75rem;
        font-weight: 700;
        background: transparent !important;
        border: none !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-radius: 0 !important;
        padding-left: 0 !important;
        color: #0f172a;
    }
    .title-input:focus { border-bottom-color: var(--primary-dark) !important; }

    /* Image Preview */
    .current-image-container {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    .image-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(255,255,255,0.9);
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 700;
        color: #1e293b;
    }

    .btn-update {
        background: var(--primary-dark);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: 0.3s;
    }
    .btn-update:hover { transform: translateY(-2px); background: #000; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="container py-5">
    <form action="index.php?act=update-post&id=<?= (int) $post['id'] ?>" method="POST" enctype="multipart/form-data">
        
        <div class="d-flex justify-content-between align-items-end mb-5 page-header">
            <div>
                <span class="badge bg-light text-dark border mb-2 px-3 py-2 rounded-pill small">ID Bài viết: #<?= (int) $post['id'] ?></span>
                <h2 class="fw-bold text-dark mb-0">Hiệu chỉnh nội dung</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="index.php?act=admin-posts" class="btn btn-outline-secondary px-4 py-2 border-0 fw-medium">
                    <i class="fa-solid fa-xmark me-2"></i> Hủy
                </a>
                <button type="submit" class="btn btn-update text-white shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up me-2"></i> Cập nhật ngay
                </button>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label">Tiêu đề hiển thị</label>
                            <input type="text" name="title" class="form-control title-input" 
                                   placeholder="Nhập tiêu đề..." 
                                   value="<?= e($_POST['title'] ?? $post['title']) ?>">
                            <?php if (!empty($error['title'])): ?>
                                <div class="text-danger small mt-2"><i class="fa-solid fa-triangle-exclamation me-1"></i><?= $error['title'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-0">
                            <label class="form-label mb-3">Nội dung bài viết</label>
                            <textarea name="content" rows="12" class="form-control border-0 shadow-none bg-light" 
                                      placeholder="Nội dung chi tiết..."><?= e($_POST['content'] ?? $post['content']) ?></textarea>
                            <?php if (!empty($error['content'])): ?>
                                <div class="text-danger small mt-2"><i class="fa-solid fa-triangle-exclamation me-1"></i><?= $error['content'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="form-label mb-3">Hình ảnh đại diện</h6>
                        
                        <div class="current-image-container mb-4">
                            <span class="image-badge">ẢNH HIỆN TẠI</span>
                            <?php if (!empty($post['image'])): ?>
                                <img src="uploads/<?= e(basename($post['image'])) ?>" alt="Current image" class="img-fluid w-100 shadow-sm" style="height: 220px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                                    <i class="fa-regular fa-image fa-3x opacity-25"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="upload-section">
                            <label class="form-label">Thay đổi ảnh mới</label>
                            <input type="file" name="image" class="form-control bg-white border">
                            <p class="text-muted small mt-2 mb-0 italic">Lưu ý: Chỉ chọn ảnh nếu bạn muốn thay thế ảnh cũ.</p>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-circle-info me-2 text-info"></i>
                            <span class="small fw-bold">Thông tin bổ sung</span>
                        </div>
                        <p class="small text-white-50 mb-0">
                            Lần cập nhật cuối sẽ được hệ thống ghi nhận tự động. Hãy kiểm tra kỹ các lỗi chính tả trước khi xuất bản.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<?php require './views/admin/layouts/footer.php'; ?>