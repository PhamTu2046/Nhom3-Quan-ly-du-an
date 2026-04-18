<?php require './views/admin/layouts/header.php'; ?>

<style>
    :root {
        --admin-dark: #1e293b;
        --admin-accent: #c5a059; /* Màu vàng champagne sang trọng */
    }

    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
    .page-title { font-weight: 800; color: #0f172a; letter-spacing: -0.02em; }
    
    /* Card & Container */
    .card { border-radius: 20px; border: none; overflow: hidden; }
    .form-label { font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.6rem; }
    
    /* Input Styling */
    .form-control, .form-select { 
        border-radius: 12px; 
        padding: 0.75rem 1rem; 
        border: 2px solid #f1f5f9; 
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus { 
        border-color: var(--admin-dark); 
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(30, 41, 59, 0.03); 
    }

    /* Price Badge */
    .price-input-group { position: relative; }
    .price-input-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    .price-input-group input { padding-left: 40px; font-weight: 700; color: #1e293b; }

    /* Image Section */
    .current-img-wrapper {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        background: #fff;
    }
    .img-placeholder { height: 200px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #94a3b8; }

    /* Action Buttons */
    .btn-update { background-color: var(--admin-dark); border: none; padding: 0.8rem 2.5rem; border-radius: 12px; font-weight: 600; transition: 0.3s; }
    .btn-update:hover { background-color: #000; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }
    .btn-back { border-radius: 12px; font-weight: 500; border: 1px solid #e2e8f0; color: #64748b; background: #fff; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item small"><a href="index.php?act=list-product" class="text-decoration-none text-muted">Sản phẩm</a></li>
                    <li class="breadcrumb-item small active text-dark fw-bold">Chỉnh sửa</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0">Hiệu chỉnh món ăn</h2>
        </div>
        <a href="index.php?act=list-product" class="btn btn-back px-4 py-2 shadow-sm">
            <i class="fa-solid fa-chevron-left me-2"></i> Quay lại
        </a>
    </div>

    <?php if (!empty($error['general'])): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <i class="fa-solid fa-circle-exclamation me-2"></i><?= $error['general'] ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=update-product&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label">Tên món ăn</label>
                            <input type="text" name="name" class="form-control form-control-lg fw-bold"
                                   placeholder="VD: Sashimi Cá Hồi Tươi"
                                   value="<?= e($_POST['name'] ?? $product['name']) ?>">
                            <?php if (!empty($error['name'])): ?>
                                <small class="text-danger mt-1 d-block fw-medium"><?= $error['name'] ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea name="description" class="form-control" rows="10" 
                                      placeholder="Mô tả hương vị, thành phần..."><?= e($_POST['description'] ?? $product['description']) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label d-block">Ảnh đại diện</label>
                            <div class="current-img-wrapper mb-3">
                                <?php if (!empty($product['image'])): ?>
                                    <img src="uploads/<?= e($product['image']) ?>" alt="Product image" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="img-placeholder"><i class="fa-regular fa-image fa-3x"></i></div>
                                <?php endif; ?>
                            </div>
                            <label class="form-label small text-muted">Đổi hình ảnh mới</label>
                            <input type="file" name="image" class="form-control bg-white">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Giá niêm yết (VNĐ)</label>
                            <div class="price-input-group">
                                <i class="fa-solid fa-coins"></i>
                                <input type="number" name="price" class="form-control" min="1" max="99999999.99" step="0.01"
                                       value="<?= e($_POST['price'] ?? $product['price']) ?>">
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted" style="font-size: 0.7rem;">Tối đa: 99.9M</small>
                                <?php if (!empty($error['price'])): ?>
                                    <small class="text-danger fw-medium"><?= $error['price'] ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Danh mục món</label>
                            <select name="category_id" class="form-select fw-medium">
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cate): ?>
                                    <option value="<?= $cate['id'] ?>"
                                        <?= (($_POST['category_id'] ?? $product['category_id']) == $cate['id']) ? 'selected' : '' ?>>
                                        <?= e($cate['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($error['category'])): ?>
                                <small class="text-danger mt-1 d-block fw-medium"><?= $error['category'] ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-update text-white shadow-sm">
                        <i class="fa-solid fa-check-double me-2"></i> Lưu thay đổi
                    </button>
                    <p class="text-center text-muted small mb-0">
                        <i class="fa-solid fa-info-circle me-1"></i> ID món ăn: #<?= $product['id'] ?>
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    const form = document.querySelector("form");

    // ===== SUBMIT VALIDATE =====
    form.addEventListener("submit", function(e) {
        let isValid = true;

        const name = document.querySelector('input[name="name"]');
        const price = document.querySelector('input[name="price"]');
        const category = document.querySelector('select[name="category_id"]');
        const image = document.querySelector('input[name="image"]');

        // reset lỗi
        document.querySelectorAll('.error-text').forEach(el => el.remove());

        // ===== NAME =====
        if (name.value.trim() === '') {
            showError(name, "Tên không được để trống");
            isValid = false;
        } else if (name.value.length < 3) {
            showError(name, "Tên tối thiểu 3 ký tự");
            isValid = false;
        }

        // ===== PRICE =====
        if (price.value === '' || price.value <= 0) {
            showError(price, "Giá phải > 0");
            isValid = false;
        }

        // ===== CATEGORY =====
        if (category.value === '') {
            showError(category, "Chọn danh mục");
            isValid = false;
        }

        // ===== IMAGE (KHÔNG BẮT BUỘC) =====
        if (image.files.length > 0) {
            const file = image.files[0];
            const allowed = ['image/jpeg','image/png','image/webp'];

            if (!allowed.includes(file.type)) {
                showError(image, "Chỉ JPG, PNG, WEBP");
                isValid = false;
            }

            // if (file.size > 2 * 1024 * 1024) {
            //     showError(image, "Ảnh tối đa 2MB");
            //     isValid = false;
            // }
        }

        if (!isValid) e.preventDefault();
    });


    // ===== REALTIME VALIDATE =====
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', () => {
            const wrapper = input.closest('.mb-4, .mb-0');
            const error = wrapper?.querySelector('.error-text');
            if (error) error.remove();

            // validate realtime luôn
            if (input.name === 'name') {
                if (input.value.trim().length > 0 && input.value.length < 3) {
                    showError(input, "Tối thiểu 3 ký tự");
                }
            }

            if (input.name === 'price') {
                if (input.value !== '' && input.value <= 0) {
                    showError(input, "Giá phải > 0");
                }
            }
        });
    });


    // ===== SHOW ERROR =====
    function showError(input, message) {
        const wrapper = input.closest('.mb-4, .mb-0');
        if (!wrapper) return;

        const error = document.createElement("small");
        error.className = "text-danger d-block mt-1 fw-medium error-text";
        error.innerText = message;

        wrapper.appendChild(error);
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php require './views/admin/layouts/footer.php'; ?>