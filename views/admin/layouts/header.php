<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($pageTitle ?? 'Trang quản trị') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {

            background: #f5f7fb;

        }

        .sidebar-link {

            border-radius: 10px;

            transition: 0.2s ease;

        }

        .sidebar-link:hover,

        .sidebar-link.active {

            background: rgba(255, 255, 255, 0.12);

        }

        .stat-card {

            border: 0;

            border-radius: 16px;

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);

        }

    </style>

</head>

<body>



<?php require './views/admin/layouts/sidebar.php'; ?>



<div class="p-4 w-100">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>

            <h1 class="h3 mb-1"><?= e($pageTitle ?? 'Trang quản trị hệ thống') ?></h1>

            <p class="text-muted mb-0">Quản lý sản phẩm, danh mục, đơn hàng, người dùng và bài viết của dự án.</p>

        </div>

        <div class="text-end">

            <div class="fw-semibold"><?= e($_SESSION['user']['name'] ?? 'Administrator') ?></div>

            <small class="text-muted"><?= e($_SESSION['user']['email'] ?? '') ?></small>

        </div>

    </div>



    <?php if ($success = getFlash('success')): ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <?= $success ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>



    <?php if ($error = getFlash('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <?= $error ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>