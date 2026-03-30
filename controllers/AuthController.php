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

        $username = trim($_POST['ten_dang_nhap'] ?? '');
        $password = trim($_POST['mat_khau'] ?? '');

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if (!$user) {
            $error = "Tài khoản không tồn tại!";
            require './views/client/login.php';
            return;
        }

        // ✅ ĐẶT Ở ĐÂY (chỗ bạn hỏi)
       if ($password !== $user['password']) {
    $error = "Sai mật khẩu!";
    require './views/client/login.php';
    return;
}

        // ✅ login thành công
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            header('Location: index.php?act=admin');
            exit();
        }

        header('Location: index.php?act=home');
        exit();
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

            $username = trim($_POST['ten_dang_nhap'] ?? '');
            $password = trim($_POST['mat_khau'] ?? '');
            $name = trim($_POST['ho_ten'] ?? '');
            $phone = trim($_POST['so_dien_thoai'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $address = trim($_POST['dia_chi'] ?? '');

            $error = "";

            // ✅ validate rỗng
            if (empty($username) || empty($password) || empty($name) || empty($phone) || empty($email)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            }

            // ✅ username
            elseif (strlen($username) < 4) {
                $error = "Tên đăng nhập phải >= 4 ký tự";
            }

            // ✅ password
            elseif (strlen($password) < 6) {
                $error = "Mật khẩu phải >= 6 ký tự";
            }

            // ✅ email
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ";
            }

            // ✅ phone
            elseif (!preg_match('/^0[0-9]{9}$/', $phone)) {
                $error = "SĐT không hợp lệ";
            }

            if (!empty($error)) {
                require './views/client/register.php';
                return;
            }

            $userModel = new UserModel();

            // ✅ check email
            if ($userModel->getUserByEmail($email)) {
                $error = "Email đã tồn tại!";
                require './views/client/register.php';
                return;
            }

            // ✅ check username
            if ($userModel->getUserByUsername($username)) {
                $error = "Tên đăng nhập đã tồn tại!";
                require './views/client/register.php';
                return;
            }

            // ✅ mã hóa password
            $userModel->insertUser($username, $password, $email, $phone, $address, 'customer');

            // 👉 insert
            $userModel->insertUser($username, $hashedPassword, $email, $phone, $address, 'customer');

            header('Location: index.php?act=login');
            exit();
        }
    }
}