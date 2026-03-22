<?php require './views/layouts/header.php'; ?>

<h2 class="mb-3">Danh sách món ăn</h2>

<a href="index.php?act=add-product" class="btn btn-primary">Thêm món</a>
<a href="index.php?act=trash-product" class="btn btn-danger">Thùng rác</a>

<table class="table table-bordered mt-3">
    <tr>
        <th>ID</th>
        <th>Tên món</th>
        <th>Ảnh</th>
        <th>Danh mục</th>
        <th>Giá</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td>
                <?php if (!empty($product['image'])): ?>
                    <img src="uploads/<?= $product['image'] ?>" width="80">
                <?php endif; ?>
            </td>
            <td><?= $product['category_name'] ?></td>
            <td><?= number_format($product['price']) ?> đ</td>
            <td>
                <a href="index.php?act=edit-product&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a href="index.php?act=delete-product&id=<?= $product['id'] ?>"
                   onclick="return confirm('Xóa nhé?')"
                   class="btn btn-danger btn-sm">
                   Xóa
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require './views/layouts/footer.php'; ?>