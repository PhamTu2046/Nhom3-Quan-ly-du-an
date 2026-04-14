<?php
require_once '../commons/env.php';
require_once '../commons/function.php';

session_start();

date_default_timezone_set('Asia/Ho_Chi_Minh');

$total = $_GET['total'] ?? 0;

// ===== CONFIG =====
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/Nhom3-Agile/Du-an-agile/index.php?act=checkout";

$vnp_TmnCode = "OXUBBNQH";
$vnp_HashSecret = "E9E8XWRVM66VT6VCMC944NPVJPDP938J";

// ===== DATA =====
$vnp_TxnRef = time();
$vnp_OrderInfo = "Thanh toan don hang";
$vnp_Amount = (int)$total * 100;
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = [
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_ExpireDate" => date('YmdHis', strtotime('+15 minutes')),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => "vn",
    "vnp_OrderInfo" => "Thanh toan don hang",
    "vnp_OrderType" => "billpayment",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_SecureHashType" => "SHA512",
];

ksort($inputData);

$queryArr = [];
$hashdataArr = [];

foreach ($inputData as $key => $value) {
    $queryArr[] = urlencode($key) . "=" . urlencode($value); // dùng cho URL
    $hashdataArr[] = urlencode($key) . "=" . urlencode($value); // dùng để tạo chữ ký theo docs
}

$query = implode('&', $queryArr);
$hashdata = implode('&', $hashdataArr);

$vnpSecureHash = strtoupper(hash_hmac('sha512', $hashdata, $vnp_HashSecret));

$vnp_Url = $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;

// redirect
header('Location: ' . $vnp_Url);
exit();