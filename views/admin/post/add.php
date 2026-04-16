<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --admin-primary: #1a1a1a;
        --admin-accent: #3498db;
        --admin-bg: #f8f9fa;
    }

    body { background-color: var(--admin-bg); font-family: 'Inter', sans-serif; }
    
    .page-title { font-weight: 800; letter-spacing: -0.02em; color: #1e293b; }
    
    /* Card Styling */
    .card { border-radius: 12px; border: none; }
    .card-title { font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; }
    
    /* Form Styling */
    .form-label { font-weight: 500; color: #334155; font-size: 0.9rem; }
    .form-control { 
        border-radius: 8px; 
        padding: 0.75rem 1rem; 
        border: 1px solid #e2e8f0; 
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .form-control:focus { 
        border-color: var(--admin-accent); 
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1); 
    }
    
    /* Image Preview Placeholder */
    .image-upload-wrapper {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: #fcfcfc;
        cursor: pointer;
        transition: 0.3s;
    }
    .image-upload-wrapper:hover { border-color: var(--admin-accent); background: #f1f5f9; }
    
    .btn-save { padding: 0.8rem 2rem; font-weight: 600; border-radius: 8px; }
</style>

<div class="container py-4">
    <form action="index.php?act=store-post" method="POST" enctype="multipart/form-data">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="page-title mb-1">Soạn thảo bài viết</h2>
                <p class="text-muted small mb-0">Tạo nội dung mới cho blog của bạn một cách chuyên nghiệp.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="index.php?act=admin-posts" class="btn btn-outline-secondary px-4">Hủy</a>
                <button type="submit" class="btn btn-dark btn-save px-4 shadow-sm">Xuất bản bài viết</button>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label">Tiêu đề bài viết</label>
                            <input type="text" name="title" class="form-control form-control-lg shadow-none border-0 border-bottom rounded-0 px-0 fs-3 fw-bold" 
                                   placeholder="Nhập tiêu đề tại đây..."
                                   value="<?= e($_POST['title'] ?? '') ?>">
                            <?php if (!empty($error['title'])): ?>
                                <div class="mt-2 text-danger small"><i class="fa-solid fa-circle-exclamation me-1"></i><?= $error['title'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung chi tiết</label>
                            <textarea name="content" rows="15" class="form-control border-0 bg-light" 
                                      placeholder="Kể câu chuyện của bạn..."><?= e($_POST['content'] ?? '') ?></textarea>
                            <?php if (!empty($error['content'])): ?>
                                <div class="mt-2 text-danger small"><i class="fa-solid fa-circle-exclamation me-1"></i><?= $error['content'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="card-title mb-4">Ảnh đại diện</h6>
                        
                        <div class="image-upload-wrapper mb-3" onclick="document.getElementById('post-image').click();">
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                            <p class="text-muted small mb-0">Click để tải ảnh lên</p>
                            <input type="file" name="image" id="post-image" class="d-none" onchange="previewImage(this)">
                        </div>
                        
                        <div id="image-preview-container" class="d-none mt-2">
                            <img id="image-preview" src="#" alt="Preview" class="img-fluid rounded shadow-sm">
                        </div>
                        
                        <p class="text-muted small mt-3 italic text-center">
                            Định dạng hỗ trợ: JPG, PNG, WEBP. Dung lượng tối đa 2MB.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4 text-center">
                        <i class="fa-solid fa-circle-info text-info mb-2"></i>
                        <p class="small text-muted mb-0 text-start">
                            Hãy đảm bảo tiêu đề bài viết bao quát được nội dung và ảnh đại diện có chất lượng cao để thu hút người đọc.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Hàm xem trước ảnh khi chọn file
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview-container').classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php require './views/admin/layouts/footer.php'; ?>