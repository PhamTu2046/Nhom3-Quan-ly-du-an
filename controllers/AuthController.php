<?php

class AuthController
{
    public function showLogin()
    {
        require_once './views/client/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy đúng name từ form
            $username = $_POST['ten_dang_nhap'] ?? '';
            $password = $_POST['mat_khau'] ?? '';

            $userModel = new UserModel();

            // Bạn cần sửa hàm này trong model nữa
            $user = $userModel->getUserByUsernameAndPassword($username, $password);

            if ($user) {
                // Lưu thông tin user vào session
                $_SESSION['user'] = $user;
                $_SESSION['name'] = $user['name'];

                // Phân quyền
                if ($user['role'] === 'admin') {
                    header('Location: index.php?act=admin');
                    exit();
                }

                // DB của bạn đang là 'customer' chứ không phải 'client'
                if ($user['role'] === 'customer') {
                    header('Location: index.php?act=home');
                    exit();
                }

                echo 'Role không hợp lệ';
                exit();
            } else {
                $error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
                require_once './views/client/login.php';
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: index.php?act=login');
        exit();
    }

    public function showRegister()
{
    require './views/client/register.php';
}

public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['ten_dang_nhap'] ?? '';
        $password = $_POST['mat_khau'] ?? '';
        $name = $_POST['ho_ten'] ?? '';
        $phone = $_POST['so_dien_thoai'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['dia_chi'] ?? '';

        $error = [];

        if (empty($username)) $error[] = "Tên đăng nhập không được trống";
        if (empty($password)) $error[] = "Mật khẩu không được trống";
        if (empty($email)) $error[] = "Email không được trống";

        if (!empty($error)) {
            require './views/client/register.php';
            return;
        }

        
        $userModel = new UserModel();

// ✅ check email tồn tại
$checkEmail = $userModel->getUserByEmail($email);

if ($checkEmail) {
    $error = "Email đã tồn tại!";
    require './views/client/register.php';
    return;
}

// 👉 nếu không trùng mới insert
$userModel->insertUser($username, $password, $email, $phone, $address, 'customer');

header('Location: index.php?act=login');
exit();

        
    }
}
}