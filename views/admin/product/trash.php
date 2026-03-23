<?php require './views/admin/layouts/header.php'; ?>

<h2 class="mb-3">Thùng rác (Món đã xóa)</h2>

<a href="index.php?act=list-product" class="btn btn-secondary mb-3">← Quay lại</a>

<?php if (empty($products)): ?>
    <div class="alert alert-info">Không có món nào trong thùng rác</div>
<?php else: ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên món</th>
            <th>Ảnh</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($products as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td>
                    <?php if (!empty($item['image'])): ?>
                        <img src="uploads/<?= $item['image'] ?>" width="60">
                    <?php endif; ?>
                </td>
                <td><?= number_format($item['price']) ?> đ</td>
                <td><?= $item['category_name'] ?? 'Không có' ?></td>
                <td>
                    <!-- Khôi phục -->
                    <a href="index.php?act=restore-product&id=<?= $item['id'] ?>"
                       class="btn btn-success btn-sm"
                       onclick="return confirm('Khôi phục món này?')">
                        ♻ Khôi phục
                    </a>

                    <!-- Xóa vĩnh viễn -->
                    <a href="index.php?act=force-delete-product&id=<?= $item['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Xóa vĩnh viễn? Không thể hoàn tác!')">
                        ❌ Xóa hẳn
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

<?php require './views/admin/layouts/footer.php'; ?>