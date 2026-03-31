<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gia Nhập Thánh Đường | Gourmet Haven Registration</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- ĐỊNH NGHĨA BIẾN MÀU LUXURY NOIR --- */
        :root {
            --lux-gold: #D4AF37; /* Màu vàng đồng chính */
            --lux-gold-light: #F1D38A; /* Màu vàng kim sáng */
            --lux-gold-gradient: linear-gradient(135deg, #B38B2D 0%, #F1D38A 50%, #D4AF37 100%);
            --deep-noir: #030303; /* Màu đen sâu */
            /* Nền form kính mờ xuyên thấu */
            --glass-bg: rgba(5, 5, 5, 0.65); 
        }

        body, html {
            height: 100%; margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #000; /* Màu nền tối dự phòng */
            overflow-x: hidden; /* Ngăn cuộn ngang */
            perspective: 1000px; /* Cần cho hiệu ứng 3D parallax */
        }

        /* --- KIẾN TRÚC NỀN HOÀN TOÀN MỚI --- */
        .page-scene-wrapper {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        /* 1. LỚP ẢNH NỀN CHÍNH (TÍCH HỢP TRỰC TIẾP) */
        .bg-image-layer {
            position: absolute;
            top: -10%; left: -10%; width: 120%; height: 120%; /* Phóng to một chút để tránh lộ viền */
            /* Link ảnh Unsplash ổn định về nhà hàng cao cấp */
            background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=2070'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* Filter làm mờ nhẹ và tối để form nổi lên */
            filter: blur(4px) brightness(0.4) contrast(1.1) saturate(0.9);
            will-change: transform;
        }

        /* 2. HIỆU ỨNG BỤI VÀNG PARALLAX (HẠT BAY) */
        #particles-layer {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.15;
            pointer-events: none;
            z-index: 1;
            will-change: transform;
        }

        /* 3. LỚP PHỦ CHUYỂN MÀU GÓC TỐI (VIGNETTE) */
        .page-vignette {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.6) 100%);
            z-index: 2;
        }

        /* --- KHUNG ĐĂNG KÝ (THE VAULT) --- */
        .gate-portal-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            z-index: 10;
        }

        .register-vault {
            background: var(--glass-bg);
            backdrop-filter: blur(25px) saturate(150%); /* Hiệu ứng kính mờ mạnh */
            -webkit-backdrop-filter: blur(25px) saturate(150%);
            border: 1px solid rgba(212, 175, 55, 0.2);
            padding: 60px 50px;
            width: 100%;
            max-width: 700px;
            position: relative;
            box-shadow: 0 40px 100px rgba(0,0,0,0.9);
            border-radius: 4px; /* Góc vuông sang trọng */
            transition: 0.5s all ease;
        }

        /* Hiệu ứng Shimmer (quét sáng) trên viền form */
        .register-vault::before {
            content: ""; position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
            transition: 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            z-index: 100;
            pointer-events: none;
        }
        .register-vault:hover::before { left: 100%; }

        /* Họa tiết góc thông minh */
        .vault-decor::before, .vault-decor::after {
            content: ""; position: absolute;
            width: 50px; height: 50px;
            border: 2px solid var(--lux-gold);
            opacity: 0.5; transition: 0.5s ease;
        }
        .vault-decor::before { top: 15px; left: 15px; border-right: none; border-bottom: none; }
        .vault-decor::after { bottom: 15px; right: 15px; border-left: none; border-top: none; }

        .register-vault:hover .vault-decor::before, 
        .register-vault:hover .vault-decor::after {
            width: 90px; height: 90px; opacity: 1;
        }

        /* --- TYPOGRAPHY (CHỮ SẮC NÉT) --- */
        .gate-title {
            font-family: 'Cinzel', serif;
            color: #FFFFFF;
            text-align: center;
            letter-spacing: 12px;
            font-weight: 900;
            margin-bottom: 5px;
            font-size: 2.2rem;
            /* Hiệu ứng Shimmer ánh vàng trên tiêu đề */
            background: linear-gradient(90deg, #fff 0%, var(--lux-gold) 20%, #fff 40%, var(--lux-gold) 60%, #fff 80%, var(--lux-gold) 100%);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleShimmer 10s linear infinite;
        }

        @keyframes titleShimmer {
            to { background-position: 200% center; }
        }

        .gate-subtitle {
            font-family: 'Cinzel', serif;
            color: var(--lux-gold);
            text-align: center;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 6px;
            margin-bottom: 50px;
            display: block;
            font-weight: 700;
            opacity: 0.9;
        }

        /* --- FORM INPUT (PHONG CÁCH LUX) --- */
        .lux-group {
            position: relative;
            margin-bottom: 40px;
        }

        .lux-input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: none;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            color: #F1D38A !important;
            border-radius: 0;
            padding: 10px 0 10px 30px;
            font-size: 1rem;
            transition: 0.4s;
        }

        .lux-input:focus {
            border-bottom-color: var(--lux-gold);
            box-shadow: none;
            background: rgba(212, 175, 55, 0.05) !important;
        }

        .lux-group i {
            position: absolute;
            left: 0; top: 12px;
            color: var(--lux-gold);
            font-size: 0.9rem;
            opacity: 0.8;
            transition: 0.3s;
        }

        .lux-group label {
            position: absolute;
            top: 10px; left: 30px;
            color: rgba(255,255,255,0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            pointer-events: none;
            transition: 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Hiệu ứng nhãn bay thông minh */
        .lux-input:focus ~ label,
        .lux-input:not(:placeholder-shown) ~ label {
            top: -20px; left: 0;
            font-size: 0.6rem;
            color: var(--lux-gold);
            font-weight: 700;
            letter-spacing: 3px;
        }

        .lux-input:focus ~ i { opacity: 1; transform: scale(1.1); }

        /* --- NÚT BẤM (CỔNG TIẾN VÀO) --- */
        .btn-register {
            background: transparent;
            color: var(--lux-gold);
            border: 1px solid var(--lux-gold);
            width: 100%;
            padding: 18px;
            font-weight: 800;
            margin-top: 10px;
            letter-spacing: 5px;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* Lớp nền vàng gradient bay từ bên trái sang */
        .btn-register::before {
            content: "";
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: var(--lux-gold-gradient);
            transition: 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            z-index: -1;
        }

        .btn-register:hover {
            color: #000;
            box-shadow: 0 0 40px rgba(212, 175, 55, 0.5);
            transform: translateY(-2px);
        }

        .btn-register:hover::before { left: 0; }

        /* --- FOOTER --- */
        .register-footer {
            text-align: center; margin-top: 50px;
            color: rgba(255,255,255,0.35);
        }

        .register-footer a {
            color: var(--lux-gold);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: 0.3s;
        }

        .register-footer a:hover {
            color: #fff;
            text-shadow: 0 0 10px var(--lux-gold);
        }

        /* Lỗi */
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            color: #ff8d97;
            border-radius: 0;
            font-size: 0.8rem;
            margin-top: -20px;
            margin-bottom: 30px;
        }

        /* Hiệu ứng xuất hiện tuần tự (animate delay) */
        .animate-delayed-1 { animation-delay: 0.2s; }
        .animate-delayed-2 { animation-delay: 0.4s; }
        .animate-delayed-3 { animation-delay: 0.6s; }
        .animate-delayed-4 { animation-delay: 0.8s; }
    </style>
</head>

<body>

<div class="page-scene-wrapper">
    <div class="bg-image-layer" id="bgLayer"></div>
    <div id="particles-layer"></div>
    <div class="page-vignette"></div>
</div>

<div class="gate-portal-container">
    <div class="register-vault animate__animated animate__fadeInUp animate-delayed-1" id="registerVault">
        <div class="vault-decor"></div>
        
        <div class="text-center mb-3 animate__animated animate__zoomIn animate-delayed-2">
            <i class="fa-solid fa-crown" style="color: var(--lux-gold); font-size: 1.5rem;"></i>
        </div>
        
        <h2 class="gate-title animate__animated animate__fadeIn animate-delayed-2">GIA NHẬP ELITE</h2>
        <span class="gate-subtitle animate__animated animate__fadeIn animate-delayed-2">Tạo Thẻ Hội Viên Thánh Đường Mỹ Vị</span>

        <form action="index.php?act=check-register" method="POST" autocomplete="off" class="animate__animated animate__fadeIn animate-delayed-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="lux-group">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="ten_dang_nhap" class="lux-input form-control shadow-none" placeholder=" " required>
                        <label>Danh Tính Đăng Nhập *</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="lux-group">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" name="mat_khau" class="lux-input form-control shadow-none" placeholder=" " required>
                        <label>Mã Khóa Bảo Mật *</label>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="lux-group">
                        <i class="fa-regular fa-id-card"></i>
                        <input type="text" name="ho_ten" class="lux-input form-control shadow-none" placeholder=" " required>
                        <label>Danh Tánh Quý Khách *</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="lux-group">
                        <i class="fa-solid fa-phone-retro"></i>
                        <input type="tel" name="so_dien_thoai" class="lux-input form-control shadow-none" placeholder=" " required>
                        <label>Liên Lạc Viễn Thông *</label>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="lux-group">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" class="lux-input form-control shadow-none" placeholder=" " required>
                        <label>Địa Chỉ Thư Điện Tử *</label>
                    </div>
                </div>
                
                <div class="col-12 mb-3">
                    <div class="lux-group">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <textarea name="dia_chi" class="lux-input form-control shadow-none" rows="2" placeholder=" "></textarea>
                        <label>Địa Chỉ Dinh Thự / Giao Hàng</label>
                    </div>
                </div>
            </div>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger animate__animated animate__shakeX">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-register">Yêu Cầu Đặc Quyền Hội Viên</button>
        </form>
        
        <div class="register-footer animate__animated animate__fadeIn animate-delayed-4">
            <p>Quý khách đã sở hữu đặc quyền? <a href="index.php?act=login">Tiến vào Thánh Đường</a></p>
            <a href="index.php" style="opacity: 0.5; font-size: 0.65rem;">
                <i class="fa-solid fa-arrow-left-long me-2"></i> Trở về Dinh Thự Chủ
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('mousemove', function(e) {
        let vault = document.getElementById('registerVault');
        let bgLayer = document.getElementById('bgLayer');
        let particles = document.getElementById('particles-layer');
        
        let mouseX = e.clientX / window.innerWidth;
        let mouseY = e.clientY / window.innerHeight;

        // Hiệu ứng Parallax 3D cho Form (rất nhẹ)
        let vaultTranslateX = (mouseX - 0.5) * 15; // Dịch chuyển form tối đa 15px
        let vaultTranslateY = (mouseY - 0.5) * 15;
        vault.style.transform = `translate(${vaultTranslateX}px, ${vaultTranslateY}px)`;

        // Hiệu ứng di chuyển ảnh nền (ngược chiều, mạnh hơn một chút)
        let bgTranslateX = (mouseX - 0.5) * -30; // Dịch chuyển nền tối đa 30px
        let bgTranslateY = (mouseY - 0.5) * -30;
        bgLayer.style.transform = `scale(1.1) translate(${bgTranslateX}px, ${bgTranslateY}px)`;

        // Hiệu ứng di chuyển các hạt bụi (cùng chiều, rất nhẹ)
        let particleTranslateX = (mouseX - 0.5) * 10;
        let particleTranslateY = (mouseY - 0.5) * 10;
        particles.style.transform = `translate(${particleTranslateX}px, ${particleTranslateY}px)`;
    });
</script>

</body>
</html>