<?php

function connectDB() {
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            DB_USERNAME,
            DB_PASSWORD
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}

function uploadFile($file, $folderSave) {
    if (empty($file['name']) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return null;
    }

    $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($file['name']));
    $pathStorage = trim($folderSave, '/') . '/' . time() . '_' . rand(1000, 9999) . '_' . $safeName;
    $pathSave = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($file['tmp_name'], $pathSave)) {
        return $pathStorage;
    }

    return null;
}

function deleteFile($file) {
    $pathDelete = PATH_ROOT . ltrim($file, '/');
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function formatCurrency($value) {
    return number_format((float) $value, 0, ',', '.') . ' đ';
}

function orderStatusLabels() {
    return [
        'pending' => 'Đang xác nhận đơn',
        'processing' => 'Đầu bếp đang làm món',
        'completed' => 'Món đã được phục vụ',
        'cancelled' => 'Đơn đã hủy',
    ];
}

function orderStatusDescriptions($context = 'customer') {
    if ($context === 'admin') {
        return [
            'pending' => 'Chúng tôi đang tiếp nhận và xác nhận món ăn của khách.',
            'processing' => 'Bếp đang chuẩn bị và hoàn thiện món ăn cho khách.',
            'completed' => 'Món ăn đã được phục vụ mang ra cho khách.',
            'cancelled' => 'Đơn hàng này đã được hủy và không cần chế biến.',
        ];
    }

    return [
        'pending' => 'Chúng tôi đang tiếp nhận và xác nhận món ăn của bạn.',
        'processing' => 'Đầu bếp đang chuẩn bị món ăn của bạn.',
        'completed' => 'Món ăn của bạn đã được phục vụ mang ra.',
        'cancelled' => 'Đơn hàng này đã được hủy.',
    ];
}

function orderCancelReasonLabels() {
    return [
        'change_items' => 'Muốn đổi món trong đơn',
        'apply_discount' => 'Muốn thêm hoặc thay mã giảm giá',
        'change_address' => 'Muốn thay đổi địa chỉ nhận hàng',
        'change_phone' => 'Muốn thay đổi số điện thoại nhận hàng',
        'ordered_by_mistake' => 'Đặt nhầm hoặc không còn nhu cầu',
        'other' => 'Lý do khác',
    ];
}

function setFlash($key, $message) {
    $_SESSION['flash'][$key] = $message;
}

function getFlash($key) {
    $message = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $message;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isLoggedIn() && (($_SESSION['user']['role'] ?? '') === 'admin');
}

function redirect($act) {
    header('Location: index.php?act=' . $act);
    exit();
}
