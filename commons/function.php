<?php

// Kết nối CSDL qua PDO
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
        die("Connection failed: " . $e->getMessage());
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
