<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --admin-dark: #1e293b;
        --admin-accent: #3b82f6;
    }

    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
    
    .page-title { font-weight: 800; color: #0f172a; letter-spacing: -0.02em; }
    
    /* Card Styling */
    .card { border-radius: 20px; border: none; }
    .card-header-custom { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 1.5rem; }
    
    /* Form Control Styling */
    .form-label { font-weight: 600; font-size: 0.85rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; }
    .form-control, .form-select { 
        border-radius: 12px; 
        padding: 0.75rem 1rem; 
        border: 2px solid #e2e8f0; 
        background-color: #fcfcfc;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus { 
        border-color: var(--admin-dark); 
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(30, 41, 59, 0.05); 
    }

    /* Input Group Icon */
    .input-group-text {
        background-color: #f1f5f9;
        border: 2px solid #e2e8f0;
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: #64748b;
    }
    .input-group .form-control { border-radius: 0 12px 12px 0; }

    /* Buttons */
    .btn-submit { background-color: var(--admin-dark); border: none; padding: 0.8rem 2rem; border-radius: 12px; font-weight: 600; transition: 0.3s; }
    .btn-submit:hover { background-color: #000; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .btn-back { border-radius: 10px; font-weight: 500; border-color: #e2e8f0; color: #64748b; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">Thêm món ăn mới</h2>
            <p class="text-muted small mb-0">Thiết lập thông tin sản phẩm và giá cả hiển thị trên thực đơn.</p>
        </div>
        <a href="index.php?act=list-product" class="btn btn-back btn-outline-secondary px-4">
            <i class="fa-solid fa-arrow-left me-2"></i> Quay lại
        </a>
    </div>

    <?php if (!empty($error['general'])): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= $error['general'] ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=store-product" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label">Tên món ăn</label>
                            <input type="text" name="name" class="form-control form-control-lg fw-bold" 
                                   placeholder="Ví dụ: Bò Bít Tết Sốt Tiêu Đen"
                                   value="<?= $_POST['name'] ?? '' ?>">
                            <?php if (!empty($error['name'])): ?>
                                <small class="text-danger mt-1 d-block fw-medium small"><?= $error['name'] ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Mô tả món ăn</label>
                            <textarea name="description" class="form-control" rows="8" 
                                      placeholder="Mô tả nguyên liệu, hương vị hoặc cách chế biến..."><?= $_POST['description'] ?? '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label">Giá bán (VNĐ)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-tag small"></i></span>
                                <input type="number" name="price" class="form-control fw-bold text-danger" 
                                       placeholder="0.00" min="1" max="99999999" step="1"
                                       value="<?= $_POST['price'] ?? '' ?>">
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted small">Tối đa: 99.9M</small>
                                <?php if (!empty($error['price'])): ?>
                                    <small class="text-danger fw-medium small"><?= $error['price'] ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-select">
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cate): ?>
                                    <option value="<?= $cate['id'] ?>"
                                        <?= (($_POST['category_id'] ?? '') == $cate['id']) ? 'selected' : '' ?>>
                                        <?= $cate['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($error['category'])): ?>
                                <small class="text-danger mt-1 d-block fw-medium small"><?= $error['category'] ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Hình ảnh minh họa</label>
                            <div class="upload-box border-dashed border-2 rounded-4 p-4 text-center bg-light" 
                                 onclick="document.getElementById('imgInput').click();" style="cursor: pointer; border-style: dashed !important; border-color: #cbd5e1 !important;">
                                <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                                <p class="small text-muted mb-0">Nhấn để tải ảnh lên</p>
                                <input type="file" name="image" id="imgInput" class="d-none" onchange="previewImage(this)">
                            </div>
                            <div id="previewContainer" class="mt-3 d-none">
                                <img id="previewImg" src="#" alt="Preview" class="img-fluid rounded-3 shadow-sm border">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-submit text-white shadow-sm">
                        <i class="fa-solid fa-plus me-2"></i> Xác nhận thêm món
                    </button>
                    <p class="text-center text-muted small mt-3">
                        <i class="fa-solid fa-circle-info me-1"></i> Kiểm tra kỹ thông tin trước khi lưu.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const container = document.getElementById('previewContainer');
        const img = document.getElementById('previewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                container.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    const form = document.querySelector("form");

    form.addEventListener("submit", function(e) {
        let isValid = true;

        // ===== INPUT =====
        const name = document.querySelector('input[name="name"]');
        const price = document.querySelector('input[name="price"]');
        const category = document.querySelector('select[name="category_id"]');
        const image = document.querySelector('input[name="image"]');

        // ===== RESET ERROR =====
        document.querySelectorAll('.error-text').forEach(el => el.remove());

        // ===== VALIDATE NAME =====
        if (name.value.trim() === '') {
            showError(name, "Tên món không được để trống");
            isValid = false;
        } else if (name.value.length < 3) {
            showError(name, "Tên món tối thiểu 3 ký tự");
            isValid = false;
        }

        // ===== VALIDATE PRICE =====
        if (price.value === '' || price.value <= 0) {
            showError(price, "Giá phải > 0");
            isValid = false;
        }

        // ===== VALIDATE CATEGORY =====
        if (category.value === '') {
            showError(category, "Vui lòng chọn danh mục");
            isValid = false;
        }

        // ===== VALIDATE IMAGE =====
        if (image.files.length > 0) {
            const file = image.files[0];
            const allowed = ['image/jpeg','image/png','image/webp'];
            
            // Kiểm tra định dạng file
            if (!allowed.includes(file.type)) {
                showError(image, "Chỉ cho phép JPG, PNG, WEBP");
                isValid = false;
            }
            // Kiểm tra kích thước file (tối đa 2MB)
            // if (file.size > 2 * 1024 * 1024) {
            //     showError(image, "Ảnh tối đa 2MB");
            //     isValid = false;
            // }
        }

        if (!isValid) e.preventDefault();
    });

    // ===== HIỂN THỊ ERROR =====
    function showError(input, message) {
        const error = document.createElement("small");
        error.className = "text-danger d-block mt-1 fw-medium small error-text";
        error.innerText = message;

        input.closest(".mb-4, .mb-0").appendChild(error);
    }
    // realtime remove error khi nhập
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', () => {
            const wrapper = input.closest('.mb-4, .mb-0');
            const error = wrapper.querySelector('.error-text');
            if (error) error.remove();
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php require './views/admin/layouts/footer.php'; ?>