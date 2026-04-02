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

    public function profile()
{
    if (empty($_SESSION['user'])) {
        redirect('login');
    }

    $userModel = new UserModel();
    $user = $userModel->getUserById($_SESSION['user']['id']);

    require './views/client/profile.php';
}

public function updateProfile()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('profile');
    }

    $id = $_SESSION['user']['id'];

    $data = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
    ];

    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    $errors = [];

    // ===== VALIDATE =====
    if ($data['name'] === '' || strlen($data['name']) > 100) {
        $errors['name'] = 'Tên tối đa 100 ký tự';
    }

    if ($data['email'] === '' || strlen($data['email']) > 100 || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }

    if ($data['phone'] !== '' && !preg_match('/^0\d{9}$/', $data['phone'])) {
        $errors['phone'] = 'SĐT phải 10 số, bắt đầu bằng 0';
    }

    if ($data['address'] !== '' && strlen($data['address']) > 255) {
        $errors['address'] = 'Địa chỉ tối đa 255 ký tự';
    }

    if ($password !== '') {
        if (strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu ≥ 6 ký tự';
        } elseif ($password !== $confirm) {
            $errors['confirm_password'] = 'Mật khẩu không khớp';
        }
    }

    $userModel = new UserModel();

    $existingUser = $userModel->getUserByEmail($data['email']);
    if ($existingUser && $existingUser['id'] != $id) {
        $errors['email'] = 'Email đã tồn tại';
    }

    // ===== NẾU CÓ LỖI =====
    if (!empty($errors)) {
        $user = $data; // giữ lại input
        require './views/client/profile.php';
        return;
    }

    // ===== UPDATE =====
    $userModel->updateProfileFull(
        $id,
        $data['name'],
        $data['email'],
        $data['phone'],
        $data['address'],
        $password
    );

    $_SESSION['user'] = array_merge($_SESSION['user'], $data);

    setFlash('success', 'Cập nhật thành công');
    redirect('profile');
}
}