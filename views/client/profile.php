<?php require './views/client/layouts/header.php'; ?>

<form action="index.php?act=update-profile" method="POST" class="col-md-6" novalidate>

    <div class="mb-3">
    <label>Tên</label>
    <input type="text" name="name"
           class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
           value="<?= e($user['name'] ?? '') ?>">

    <?php if (!empty($errors['name'])): ?>
        <div class="invalid-feedback">
            <?= $errors['name'] ?>
        </div>
    <?php endif; ?>
</div>

    <div class="mb-3">
    <label>Email</label>
    <input type="r=text" name="email"
           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
           value="<?= e($user['email'] ?? '') ?>">

    <?php if (!empty($errors['email'])): ?>
        <div class="invalid-feedback">
            <?= $errors['email'] ?>
        </div>
    <?php endif; ?>
</div>

    <div class="mb-3">
    <label>SĐT</label>
    <input type="text" name="phone"
           class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
           value="<?= e($user['phone'] ?? '') ?>">

    <?php if (!empty($errors['phone'])): ?>
        <div class="invalid-feedback">
            <?= $errors['phone'] ?>
        </div>
    <?php endif; ?>
</div>

    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control"
               maxlength="255"
               value="<?= e($user['address']) ?>">
    </div>

    <!-- ===== PASSWORD ===== -->
    <hr>

    <div class="mb-3">
    <label>Mật khẩu mới</label>
    <input type="password" name="password"
           class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
           placeholder="********">

    <?php if (!empty($errors['password'])): ?>
        <div class="invalid-feedback">
            <?= $errors['password'] ?>
        </div>
    <?php endif; ?>
</div>

    <div class="mb-3">
    <label>Nhập lại mật khẩu</label>
    <input type="password" name="confirm_password"
           class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
           placeholder="********">

    <?php if (!empty($errors['confirm_password'])): ?>
        <div class="invalid-feedback">
            <?= $errors['confirm_password'] ?>
        </div>
    <?php endif; ?>
</div>

    <button class="btn btn-warning">Cập nhật</button>
</form>
<?php require './views/client/layouts/footer.php'; ?>