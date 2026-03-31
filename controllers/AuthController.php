<?php

class AuthController
{
    public function showLogin()
    {
        $error = getFlash('error');
        $success = getFlash('success');
        require_once './views/client/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('login');
        }

        $credential = trim($_POST['ten_dang_nhap'] ?? '');
        $password = trim($_POST['mat_khau'] ?? '');

        $userModel = new UserModel();
        $user = $userModel->getUserByCredential($credential, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            setFlash('success', 'Đăng nhập thành công.');
            redirect($user['role'] === 'admin' ? 'admin' : 'home');
        }

        $error = 'Tên đăng nhập/email hoặc mật khẩu không đúng!';
        require_once './views/client/login.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        session_start();
        setFlash('success', 'Bạn đã đăng xuất khỏi hệ thống.');
        redirect('login');
    }

    public function showRegister()
    {
        $error = getFlash('error');
        require './views/client/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('register');
        }

        $username = trim($_POST['ten_dang_nhap'] ?? '');
        $password = trim($_POST['mat_khau'] ?? '');
        $phone = trim($_POST['so_dien_thoai'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $address = trim($_POST['dia_chi'] ?? '');

        $errors = [];

        if ($username === '') {
            $errors[] = 'Tên đăng nhập không được để trống';
        }
        if ($password === '') {
            $errors[] = 'Mật khẩu không được để trống';
        }
        if ($email === '') {
            $errors[] = 'Email không được để trống';
        }

        $userModel = new UserModel();

        if ($email !== '' && $userModel->getUserByEmail($email)) {
            $errors[] = 'Email đã tồn tại trong hệ thống';
        }

        if (!empty($errors)) {
            $error = implode('<br>', $errors);
            require './views/client/register.php';
            return;
        }

        $userModel->insertUser($username, $password, $email, $phone, $address, 'customer');

        setFlash('success', 'Đăng ký thành công. Vui lòng đăng nhập để tiếp tục.');
        redirect('login');
    }
}