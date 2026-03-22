<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Thành Viên | Gourmet Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.85)), 
                        url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            color: white;
            padding: 40px 0;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(197, 160, 89, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 600px; /* Rộng hơn đăng nhập một chút để dàn 2 cột */
            box-shadow: 0 15px 35px rgba(0,0,0,0.6);
        }
        .register-card h2 {
            font-family: 'Playfair Display', serif;
            color: #C5A059;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .form-label {
            color: #C5A059;
            font-size: 11px;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .form-control {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            border-radius: 0;
            padding: 10px 15px;
            transition: 0.3s;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.12);
            border-color: #C5A059;
            color: white;
            box-shadow: none;
        }
        .btn-register {
            background: #C5A059;
            color: black;
            border: none;
            width: 100%;
            padding: 14px;
            font-weight: 700;
            margin-top: 25px;
            letter-spacing: 2px;
            transition: 0.4s;
            text-transform: uppercase;
        }
        .btn-register:hover {
            background: #fff;
            color: #000;
            transform: translateY(-3px);
        }
        .register-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
        }
        .register-footer a {
            color: #C5A059;
            text-decoration: none;
            font-weight: 600;
        }
        /* Custom thanh cuộn nếu form dài */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #C5A059; }
    </style>
</head>
<body>

<div class="register-card">
    <h2>MEMBER REGISTRATION</h2>
    <form action="index.php?act=check-register" method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label text-uppercase">Tên đăng nhập *</label>
                <input type="text" name="ten_dang_nhap" class="form-control" placeholder="username" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-uppercase">Mật khẩu *</label>
                <input type="password" name="mat_khau" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label text-uppercase">Họ và tên *</label>
                <input type="text" name="ho_ten" class="form-control" placeholder="Nguyen Van A" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-uppercase">Số điện thoại *</label>
                <input type="tel" name="so_dien_thoai" class="form-control" placeholder="0987xxxxxx" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label text-uppercase">Địa chỉ Email *</label>
                <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label text-uppercase">Địa chỉ giao hàng</label>
                <textarea name="dia_chi" class="form-control" rows="2" placeholder="Số nhà, tên đường, phường/xã..."></textarea>
            </div>
        </div>
        <?php if (!empty($error)) : ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>

        <button type="submit" class="btn btn-register">Tham Gia Ngay</button>
    </form>
    
    <div class="register-footer">
        <p>Đã là thành viên? <a href="index.php?act=login">Đăng nhập tại đây</a></p>
        <a href="index.php" style="color: rgba(255,255,255,0.5)">← Trở về trang chủ</a>
    </div>
</div>

</body>
</html>