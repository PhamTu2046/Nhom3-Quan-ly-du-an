<?php require './views/admin/layouts/header.php'; ?>

<h2 class="mb-3">Danh sách danh mục</h2>

<a href="index.php?act=add-category" class="btn btn-primary">Thêm danh mục</a>
<a href="index.php?act=list-product" class="btn btn-secondary">Quản lý sản phẩm</a>

<table class="table table-bordered mt-3">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category['id'] ?></td>
            <td><?= $category['name'] ?></td>
            <td>
                <a href="index.php?act=edit-category&id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a href="index.php?act=delete-category&id=<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa danh mục này?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require './views/admin/layouts/footer.php'; ?>