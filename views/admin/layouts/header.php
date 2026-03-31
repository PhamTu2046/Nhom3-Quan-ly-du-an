<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
        }

        .card h3 {
            font-weight: bold;
        }

        table td, table th {
            vertical-align: middle;
            text-align: center;
        }
        #chartDay, #chartMonth {
            width: 100% !important;
            height: 400px; /* hoặc chiều cao bạn muốn */
        }
    </style>
</head>
<body>

<?php require './views/admin/layouts/sidebar.php'; ?>