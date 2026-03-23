<?php require './views/layouts/header.php'; ?>

<h2 class="mb-3">Sửa danh mục</h2>

<a href="index.php?act=list-category" class="btn btn-secondary mb-3">← Quay lại</a>

<form action="index.php?act=update-category&id=<?= $category['id'] ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control" value="<?= $_POST['name'] ?? $category['name'] ?>">

        <?php if (!empty($error['name'])): ?>
            <small class="text-danger"><?= $error['name'] ?></small>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<?php require './views/layouts/footer.php'; ?>