<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập | Gourmet Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            color: white;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(197, 160, 89, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        }
        .login-card h2 {
            font-family: 'Playfair Display', serif;
            color: #C5A059;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }
        .form-control {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            border-radius: 0;
            padding: 12px;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: #C5A059;
            color: white;
            box-shadow: none;
        }
        .btn-login {
            background: #C5A059;
            color: black;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: 600;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #d4b477;
            transform: scale(1.02);
        }
        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }
        .login-footer a {
            color: #C5A059;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="login-card">
    <h2>LOGIN</h2>

    <!-- Hiển thị lỗi -->
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=check-login" method="POST">
        <div class="mb-3">
            <label class="form-label small text-uppercase">Tên đăng nhập</label>
            <input type="text" name="ten_dang_nhap" class="form-control"
       placeholder="Nhập username..." required minlength="4">

        </div>

        <div class="mb-4">
            <label class="form-label small text-uppercase">Mật khẩu</label>
            <input type="password" name="mat_khau" class="form-control"
       placeholder="••••••••" required minlength="6">
        </div>

        <button type="submit" class="btn btn-login text-uppercase">Đăng Nhập</button>
    </form>

    <div class="login-footer">
        <p>Chưa có tài khoản? 
            <a href="index.php?act=register">Đăng ký ngay</a>
        </p>
        <a href="index.php">← Quay lại trang chủ</a>
    </div>
</div>

<script>
document.querySelector("form").addEventListener("submit", function(e) {

    const username = document.querySelector("[name='ten_dang_nhap']").value.trim();
    const password = document.querySelector("[name='mat_khau']").value.trim();

    let error = "";

    if (username === "") {
        error += "Vui lòng nhập tên đăng nhập\n";
    }

    if (password === "") {
        error += "Vui lòng nhập mật khẩu\n";
    }

    if (password.length < 6) {
        error += "Mật khẩu phải >= 6 ký tự\n";
    }

    if (error !== "") {
        alert(error);
        e.preventDefault();
    }
});
</script>
</body>
</html>