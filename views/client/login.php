<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thánh Đường Mỹ Vị | Elite Entrance</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --lux-gold: #D4AF37;
            --lux-gold-light: #F1D38A;
            --lux-gold-gradient: linear-gradient(135deg, #B38B2D 0%, #F1D38A 50%, #D4AF37 100%);
            --glass-bg: rgba(7, 7, 7, 0.75); 
            --gold-shadow: rgba(212, 175, 55, 0.3);
        }

        body, html {
            height: 100%; margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #050505;
            overflow: hidden;
            perspective: 1000px;
        }

        /* --- BACKGROUND SCENE --- */
        .page-scene-wrapper {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-image-layer {
            position: absolute;
            top: -10%; left: -10%; width: 120%; height: 120%;
            background-image: url('https://images.unsplash.com/photo-1550966841-3ee3ad359051?auto=format&fit=crop&q=80&w=2070'); 
            background-size: cover;
            background-position: center;
            filter: brightness(0.3) contrast(1.2) blur(3px);
            animation: kenBurnsSmooth 40s linear infinite alternate;
        }

        @keyframes kenBurnsSmooth {
            from { transform: scale(1) translate(0, 0); }
            to { transform: scale(1.1) translate(-2%, -2%); }
        }

        #particles-layer {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.2;
            pointer-events: none;
            z-index: 1;
        }

        .page-vignette {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at center, transparent 20%, rgba(0,0,0,0.8) 100%);
            z-index: 2;
        }

        /* --- THE VAULT CONTAINER --- */
        .gate-portal-container {
            height: 100%; display: flex; align-items: center; justify-content: center;
            padding: 20px; position: relative; z-index: 10;
        }

        .login-vault {
            background: var(--glass-bg);
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);
            border: 1px solid rgba(212, 175, 55, 0.15);
            padding: 70px 55px;
            width: 100%; max-width: 500px;
            position: relative;
            box-shadow: 0 50px 100px rgba(0,0,0,0.9), inset 0 0 20px rgba(255,255,255,0.02);
            border-radius: 2px;
            transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .login-vault:hover {
            border-color: rgba(212, 175, 55, 0.4);
            box-shadow: 0 60px 120px rgba(0,0,0,1), 0 0 30px var(--gold-shadow);
        }

        /* SHIMMER EFFECT */
        .login-vault::before {
            content: ""; position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transform: skewX(-25deg);
            transition: 0.8s;
            pointer-events: none;
        }
        .login-vault:hover::before { left: 150%; }

        /* CORNER DECOR */
        .vault-decor::before, .vault-decor::after {
            content: ""; position: absolute;
            width: 60px; height: 60px;
            border: 1.5px solid var(--lux-gold);
            opacity: 0.4; transition: 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .vault-decor::before { top: 20px; left: 20px; border-right: none; border-bottom: none; }
        .vault-decor::after { bottom: 20px; right: 20px; border-left: none; border-top: none; }

        .login-vault:hover .vault-decor::before { transform: translate(-5px, -5px); opacity: 1; }
        .login-vault:hover .vault-decor::after { transform: translate(5px, 5px); opacity: 1; }

        /* TYPOGRAPHY */
        .gate-title {
            font-family: 'Cinzel', serif;
            color: #FFFFFF;
            text-align: center;
            letter-spacing: 14px;
            font-weight: 900;
            margin-bottom: 8px;
            font-size: 2.4rem;
            background: linear-gradient(90deg, #fff 0%, var(--lux-gold-light) 50%, #fff 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleShimmer 8s linear infinite;
        }

        @keyframes titleShimmer { to { background-position: 200% center; } }

        .gate-subtitle {
            font-family: 'Cinzel', serif;
            color: var(--lux-gold);
            text-align: center;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 8px;
            margin-bottom: 55px;
            display: block;
            opacity: 0.8;
        }

        /* LUX INPUTS */
        .lux-group { position: relative; margin-bottom: 45px; }

        .lux-input {
            background: transparent !important;
            border: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #F1D38A !important;
            border-radius: 0;
            padding: 12px 0 12px 35px;
            font-size: 1.05rem;
            transition: 0.4s;
            letter-spacing: 1px;
        }

        .lux-input:focus {
            border-bottom-color: var(--lux-gold);
            box-shadow: none;
            background: rgba(212, 175, 55, 0.03) !important;
        }

        .lux-group i {
            position: absolute;
            left: 0; top: 15px;
            color: var(--lux-gold);
            font-size: 1rem;
            opacity: 0.6;
            transition: 0.4s;
        }

        .lux-group label {
            position: absolute;
            top: 14px; left: 35px;
            color: rgba(255,255,255,0.3);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            pointer-events: none;
            transition: 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .lux-input:focus ~ label,
        .lux-input:not(:placeholder-shown) ~ label {
            top: -22px; left: 0;
            font-size: 0.65rem;
            color: var(--lux-gold);
            font-weight: 700;
            letter-spacing: 4px;
        }

        .lux-input:focus ~ i { opacity: 1; transform: scale(1.1); color: #fff; }

        /* BUTTON SUPREME */
        .btn-access {
            background: transparent;
            color: #000;
            border: 1px solid var(--lux-gold);
            width: 100%;
            padding: 20px;
            font-weight: 900;
            margin-top: 15px;
            letter-spacing: 7px;
            text-transform: uppercase;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
            transition: 0.5s;
            overflow: hidden;
        }

        .btn-access::before {
            content: ""; position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: var(--lux-gold-gradient);
            z-index: -1;
            transition: 0.5s cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        .btn-access:hover {
            color: #fff;
            box-shadow: 0 0 40px var(--gold-shadow);
            transform: translateY(-3px);
            border-color: #fff;
        }

        .btn-access:hover::before { filter: brightness(1.2) contrast(1.1); }

        /* FOOTER */
        .vault-footer { text-align: center; margin-top: 55px; }
        .footer-text { color: rgba(255,255,255,0.4); font-size: 0.8rem; margin-bottom: 25px; }
        .vault-link {
            color: var(--lux-gold);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            transition: 0.3s;
            position: relative;
        }

        .vault-link::after {
            content: ""; position: absolute; bottom: -5px; left: 0;
            width: 0; height: 1px; background: var(--lux-gold);
            transition: 0.3s;
        }
        .vault-link:hover { color: #fff; }
        .vault-link:hover::after { width: 100%; }


        /* Fix lệch nút "Yêu cầu thẻ hội viên" */
        .vault-link {
    position: relative;
    z-index: 10;
    display: inline-block;
    padding: 10px 0;
}
.login-vault::before,
.vault-decor::before,
.vault-decor::after {
    pointer-events: none;
    z-index: 0;
}
.login-vault {
    position: relative;
    z-index: 5;
}
.page-scene-wrapper,
.bg-image-layer,
#particles-layer,
.page-vignette {
    pointer-events: none;
}
    </style>
</head>

<body>

<div class="page-scene-wrapper">
    <div class="bg-image-layer"></div>
    <div id="particles-layer"></div>
    <div class="page-vignette"></div>
</div>

<?php $old = $old ?? []; ?>
<div class="gate-portal-container">
    <div class="login-vault animate__animated animate__fadeIn" id="loginVault">
        <div class="vault-decor"></div>
        
        <div class="text-center mb-4">
            <i class="fa-solid fa-crown animate__animated animate__fadeInDown animate__delay-1s" 
               style="color: var(--lux-gold); font-size: 1.8rem; filter: drop-shadow(0 0 10px var(--lux-gold));"></i>
        </div>
        
        <h2 class="gate-title">MỸ VỊ ELITE</h2>
        <span class="gate-subtitle">The Vault Membership</span>

        <form action="index.php?act=check-login" method="POST" autocomplete="off" class="animate__animated animate__fadeInUp animate__delay-1s">
            <div class="lux-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="ten_dang_nhap" value="<?= e($old['ten_dang_nhap'] ?? '') ?>" class="lux-input form-control shadow-none <?= isset($errors['ten_dang_nhap']) ? 'is-invalid' : '' ?>" placeholder=" " required>
                <label>Tên đăng nhập</label>
                </label>
                <?php if (!empty($errors['ten_dang_nhap'])): ?>
                    <div class="invalid-feedback d-block">
                        <?= $errors['ten_dang_nhap'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="lux-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="mat_khau" class="lux-input form-control shadow-none <?= isset($errors['mat_khau']) ? 'is-invalid' : '' ?>" placeholder=" " required>
                <label>Mật khẩu</label>
                <?php if (!empty($errors['mat_khau'])): ?>
                    <div class="invalid-feedback d-block">
                        <?= $errors['mat_khau'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger mt-3 animate__animated animate__shakeX">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-access">
                Tiến Vào Thánh Đường
            </button>
        </form>

        <div class="vault-footer animate__animated animate__fadeIn animate__delay-2s">
            <p class="footer-text">Quý khách chưa sở hữu đặc quyền truy cập?</p>
            <div class="d-flex flex-column gap-3">
                <a href="index.php?act=register" class="vault-link">Yêu cầu thẻ hội viên</a>
                <a href="index.php" class="vault-link" style="opacity: 0.6; font-size: 0.65rem;">
                    <i class="fa-solid fa-chevron-left me-2"></i>Quay về sảnh chính
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const vault = document.getElementById('loginVault');
    const particles = document.getElementById('particles-layer');
    
    document.addEventListener('mousemove', (e) => {
        const x = (window.innerWidth / 2 - e.pageX) / 45;
        const y = (window.innerHeight / 2 - e.pageY) / 45;
        
        // Parallax mượt mà hơn với CSS transitions tự động
        vault.style.transform = `rotateY(${x}deg) rotateX(${-y}deg) translateZ(10px)`;
        
        // Hạt bụi di chuyển ngược hướng tạo chiều sâu
        particles.style.transform = `translateX(${-x * 2}px) translateY(${-y * 2}px)`;
    });
</script>

</body>
</html>