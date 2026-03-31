<?php require './views/admin/layouts/header.php'; ?>

<h2 class="mb-3">Sửa món ăn</h2>

<a href="index.php?act=list-product" class="btn btn-secondary mb-3">← Quay lại</a>

<form action="index.php?act=update-product&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">

    <!-- Tên món -->
    <div class="mb-3">
        <label class="form-label">Tên món</label>
        <input type="text" name="name" class="form-control"
               value="<?= $_POST['name'] ?? $product['name'] ?>">

        <?php if (!empty($error['name'])): ?>
            <small class="text-danger"><?= $error['name'] ?></small>
        <?php endif; ?>
    </div>

    <!-- Ảnh -->
    <div class="mb-3">
        <label>Ảnh hiện tại</label><br>
        <?php if (!empty($product['image'])): ?>
            <img src="uploads/<?= $product['image'] ?>" width="100">
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label>Đổi ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>

    <!-- Giá -->
    <div class="mb-3">
        <label class="form-label">Giá</label>
        <input type="number" name="price" class="form-control"
               value="<?= $_POST['price'] ?? $product['price'] ?>">

        <?php if (!empty($error['price'])): ?>
            <small class="text-danger"><?= $error['price'] ?></small>
        <?php endif; ?>
    </div>

    <!-- Danh mục -->
    <div class="mb-3">
        <label class="form-label">Danh mục</label>
        <select name="category_id" class="form-control">
            <option value="">-- Chọn danh mục --</option>

            <?php foreach ($categories as $cate): ?>
                <option value="<?= $cate['id'] ?>"
                    <?= (
                        ($_POST['category_id'] ?? $product['category_id']) == $cate['id']
                    ) ? 'selected' : '' ?>>
                    <?= $cate['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if (!empty($error['category'])): ?>
            <small class="text-danger"><?= $error['category'] ?></small>
        <?php endif; ?>
    </div>

    <!-- Mô tả -->
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control"><?= $_POST['description'] ?? $product['description'] ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<?php require './views/admin/layouts/footer.php'; ?>