<?php require './views/client/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@200;300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --ultra-gold: #D4AF37; /* Màu vàng kim loại quý */
        --ultra-gold-dim: #AA8C30;
        --deep-noir: #050505; /* Đen sâu thẳm, gần như tuyệt đối */
        --slate-gray: #111111;
        --soft-white: #FDFBF8;
        --glass-bg: rgba(255, 255, 255, 0.01); /* Kính mờ siêu mỏng */
        --pattern-opacity: 0.04;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--deep-noir); /* Nền tối toàn trang */
        color: rgba(255,255,255,0.7);
        overflow-x: hidden;
        letter-spacing: 0.5px;
    }

    /* --- Hiệu ứng Parallax Background toàn trang --- */
    .parallax-bg-wrapper {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: -2;
        overflow: hidden;
    }
    .parallax-bg {
        width: 100%; height: 120%; /* Cao hơn 20% để phục vụ parallax */
        background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2070&auto=format&fit=crop'); /* Ảnh nhà hàng ánh sáng nến mờ */
        background-size: cover;
        background-position: center;
        filter: blur(4px) grayscale(20%);
        /* Hiệu ứng Ken Burns mượt mà hơn */
        animation: kenBurnsPage 60s infinite alternate;
        will-change: transform;
    }

    @keyframes kenBurnsPage {
        0% { transform: scale(1.1) translateY(0); }
        100% { transform: scale(1.15) translateY(-5%); }
    }

    /* Lớp phủ tối mờ toàn trang */
    .page-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(5,5,5,0.98), rgba(0,0,0,0.85));
        z-index: -1;
    }

    /* --- Common Luxury Elements --- */
    .cinzel-font { font-family: 'Cinzel', serif; }
    
    .text-gold { color: var(--ultra-gold) !important; }
    
    .letter-spacing-huge { letter-spacing: 10px; text-transform: uppercase; }
    
    .section-title-lux {
        font-family: 'Cinzel', serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        letter-spacing: -2px;
        line-height: 1.1;
        margin-bottom: 40px;
    }
    
    .section-divider-gold {
        width: 80px;
        height: 2px;
        background-color: var(--ultra-gold);
        margin: 0 auto 50px auto;
    }

    /* Họa tiết Art Deco chìm */
    .pattern-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://www.transparenttextures.com/patterns/black-linen.png'); /* Texture vải cao cấp */
        opacity: var(--pattern-opacity);
        pointer-events: none;
    }

    /* --- Section 1: Cinematic Hero --- */
    .hero-cinematic {
        height: 100vh; /* Chiếm trọn màn hình */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .hero-title-big {
        font-family: 'Cinzel', serif;
        font-size: 6rem;
        font-weight: 700;
        letter-spacing: -3px;
        color: white;
        line-height: 1;
        text-shadow: 0 10px 30px rgba(0,0,0,0.8);
    }

    /* --- Section 2: Glassmorphism Stats --- */
    .stats-section {
        position: relative;
        z-index: 10;
        margin-top: -120px; /* Đè lên Hero */
        margin-bottom: 150px;
    }

    .stat-container-glass {
        background: var(--glass-bg);
        backdrop-filter: blur(25px); /* Làm mờ kính */
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.04);
        border-radius: 0;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
    }

    .stat-item {
        padding: 70px 30px;
        border-right: 1px solid rgba(255, 255, 255, 0.02);
        text-align: center;
        transition: 0.5s;
    }

    .stat-item:last-child { border-right: none; }
    
    .stat-item:hover {
        background: rgba(255, 255, 255, 0.015);
        transform: translateY(-8px);
    }

    .stat-number {
        font-family: 'Cinzel', serif;
        font-size: 4rem;
        font-weight: 700;
        color: white;
        margin-bottom: 8px;
        text-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
    }

    .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 6px; /* Khoảng cách chữ cực rộng */
        color: var(--ultra-gold);
        font-weight: 600;
    }

    /* --- Section 3: Heritage Story --- */
    .heritage-section {
        padding: 150px 0;
        background-color: var(--slate-gray);
        position: relative;
    }

    .heritage-content-card {
        background: transparent;
        border: none;
        padding-right: 60px;
    }

    .heritage-visual {
        position: relative;
        height: 100%;
        min-height: 500px;
        background-image: url('https://images.unsplash.com/photo-1551887196-72e32aff7af0?q=80&w=1920&auto=format&fit=crop'); /* Ảnh bếp trưởng phục vụ món */
        background-size: cover;
        background-position: center;
        border: 10px solid var(--glass-bg);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }
    
    .heritage-visual-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to bottom, rgba(17,17,17,0), var(--slate-gray));
    }

    /* --- Section 4: Culinary Art (Pillars) --- */
    .culinary-art-section {
        padding: 150px 0;
        position: relative;
    }
    
    .pillar-card {
        background: rgba(255, 255, 255, 0.01);
        border: 1px solid rgba(255, 255, 255, 0.02);
        padding: 50px;
        text-align: center;
        transition: 0.5s;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .pillar-card::before {
        content: "";
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 0;
        background-color: var(--ultra-gold);
        transition: 0.5s ease-out;
        z-index: -1;
    }
    
    .pillar-card:hover {
        transform: translateY(-15px);
        border-color: var(--ultra-gold-dim);
    }
    
    .pillar-card:hover::before {
        height: 100%;
    }
    
    .pillar-card:hover .pillar-icon,
    .pillar-card:hover .pillar-title,
    .pillar-card:hover .pillar-text {
        color: var(--deep-noir) !important;
    }

    .pillar-icon {
        font-size: 3rem;
        color: var(--ultra-gold);
        margin-bottom: 30px;
        transition: 0.3s;
    }
    
    .pillar-title {
        font-family: 'Cinzel', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: white;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
    }
    
    .pillar-text {
        font-size: 0.9rem;
        line-height: 1.8;
        font-weight: 300;
        color: rgba(255,255,255,0.6);
        transition: 0.3s;
    }

    /* --- Section 5: Signature Collections (Split Panel) --- */
    .collections-section {
        padding: 150px 0;
        background-color: var(--slate-gray);
        position: relative;
    }
    
    .collection-panel {
        background-color: var(--deep-noir);
        padding: 80px;
        height: 100%;
        border-left: 4px solid var(--ultra-gold);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .category-link-ultra {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 35px;
        background: rgba(255,255,255,0.015);
        border: 1px solid rgba(255,255,255,0.02);
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 4px; /* Khoảng cách chữ rộng */
        transition: 0.5s;
        font-weight: 500;
    }

    .category-link-ultra:hover {
        border-color: var(--ultra-gold);
        color: var(--ultra-gold);
        padding-left: 50px; /* Hiệu ứng đẩy sang phải */
        background: rgba(255,255,255,0.03);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    /* --- Section 6: Elite Membership --- */
    .membership-section {
        padding: 150px 0;
        background-image: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.9)), 
                          url('https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1920&auto=format&fit=crop'); /* Ảnh ly rượu vang trong không gian mờ */
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Hiệu ứng Parallax */
        position: relative;
        text-align: center;
    }
    
    .membership-card {
        background: var(--glass-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 175, 55, 0.2);
        padding: 80px;
        max-width: 900px;
        margin: 0 auto;
    }

    /* --- Ultra Luxury Buttons --- */
    .btn-gold-ultra {
        background: transparent;
        color: var(--ultra-gold);
        border: 1px solid var(--ultra-gold);
        border-radius: 0;
        padding: 22px 60px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 5px; /* Khoảng cách chữ cực rộng */
        font-weight: 600;
        position: relative;
        overflow: hidden;
        transition: 0.5s;
        z-index: 1;
    }

    .btn-gold-ultra::before {
        content: "";
        position: absolute;
        top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.6s;
    }

    .btn-gold-ultra:hover {
        color: var(--deep-noir);
        background-color: var(--ultra-gold);
        box-shadow: 0 0 40px rgba(212, 175, 55, 0.4);
    }
    
    .btn-gold-ultra:hover::before {
        left: 100%;
    }
    
    .btn-outline-gold {
        background: transparent;
        color: rgba(255,255,255,0.8);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 0;
        padding: 18px 50px;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 3px;
        font-weight: 500;
        transition: 0.4s;
    }
    
    .btn-outline-gold:hover {
        border-color: var(--ultra-gold);
        color: var(--ultra-gold);
        background: rgba(212, 175, 55, 0.05);
    }

</style>

<div class="parallax-bg-wrapper">
    <div class="parallax-bg"></div>
</div>
<div class="page-overlay"></div>

<div class="container-fluid p-0">
    
    <section class="hero-cinematic text-center">
        <div class="pattern-overlay"></div>
        <div class="container">
            <span class="hero-subtitle mb-3 d-block animate__animated animate__fadeInDown letter-spacing-huge">Giới thiệu hệ thống</span>
            <h1 class="hero-title-big mb-5 animate__animated animate__fadeInUp animate__delay-1s cinzel-font">Agile Food <br> <span style="font-weight: 200; opacity: 0.7;">Website đặt món trực tuyến</span></h1>
            <div class="section-divider-gold animate__animated animate__fadeIn animate__delay-2s"></div>
            <p class="lead mx-auto mb-5 text-white-50 animate__animated animate__fadeIn animate__delay-2s" style="max-width: 800px; font-weight: 200; letter-spacing: 1.5px; line-height: 2;">
                Đây là dự án quản lý bán đồ ăn trực tuyến với các nhóm sản phẩm chính như Pizza, Burger và Đồ uống, hỗ trợ giỏ hàng, đặt hàng và quản trị nội dung.
            </p>
            <a href="index.php?act=menu" class="btn btn-gold-ultra shadow-lg animate__animated animate__zoomIn animate__delay-3s">
                Xem thực đơn hiện có
            </a>
        </div>
    </section>

    <section class="stats-sectioncontainer" id="statsBar">
        <div class="container">
            <div class="stat-container-glass rounded-0 shadow-lg" data-aos="fade-up" data-aos-duration="1000">
                <div class="row g-0">
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-number cinzel-font"><?= (int) $stats['products'] ?></div>
                            <div class="stat-label">Sản phẩm hiện có</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-number cinzel-font"><?= (int) $stats['categories'] ?></div>
                            <div class="stat-label">Danh mục món ăn</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-number cinzel-font"><?= (int) $stats['customers'] ?></div>
                            <div class="stat-label">Khách hàng</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-number cinzel-font"><?= (int) $stats['orders'] ?></div>
                            <div class="stat-label">Đơn hàng</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="heritage-section">
        <div class="pattern-overlay"></div>
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1200">
                    <div class="heritage-content-card text-start">
                        <span class="text-gold text-uppercase small letter-spacing-huge mb-3 d-block">Genesis</span>
                        <h2 class="section-title-lux">Huyền thoại & Di sản</h2>
                        <div class="section-divider-gold m-0 mb-5"></div>
                        <p class="text-white-50 mb-5" style="line-height: 2.2; font-weight: 300; font-size: 1.05rem; letter-spacing: 1px;">
                            Agile Food không chỉ đơn thuần là một thương hiệu; đó là một di sản về sự hoàn hảo. Được kiến tạo bởi những bậc thầy ẩm thực hàng đầu, chúng tôi theo đuổi triết lý kết hợp tinh hoa nguyên liệu quý hiếm với nghệ thuật chế biến bậc thầy. Mỗi món ăn là một chương trong câu chuyện về niềm đam mê và sự cống hiến không ngừng nghỉ cho mỹ vị vĩnh cửu.
                        </p>
                        <p class="text-muted fst-italic mb-5 fw-light" style="font-size: 0.95rem; border-left: 2px solid var(--ultra-gold); padding-left: 25px;">
                            "Chúng tôi không phục vụ bữa ăn; chúng tôi kiến tạo những khoảnh khắc lịch sử của vị giác ngay tại không gian biệt lập của Quý khách."
                        </p>
                        <a href="#" class="btn btn-outline-gold">Tìm hiểu hành trình của chúng tôi</a>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">
                    <div class="heritage-visual rounded-0 shadow-lg">
                        <div class="heritage-visual-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="culinary-art-section text-center">
        <div class="container">
            <span class="text-gold text-uppercase small letter-spacing-huge mb-3 d-block">Pillars of Mastery</span>
            <h2 class="section-title-lux">Tôn chỉ của sự hoàn hảo</h2>
            <div class="section-divider-gold"></div>
            
            <div class="row g-4 mt-5">
                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1000">
                    <div class="pillar-card shadow-lg">
                        <div class="pillar-icon"><i class="fa-solid fa-gem"></i></div>
                        <h4 class="pillar-title">Nguyên liệu Tinh tuyển</h4>
                        <p class="pillar-text">Chỉ những nguyên liệu hạng nhất, được tuyển chọn khắt khe từ các nguồn cung ứng độc quyền toàn cầu mới được phép bước vào gian bếp của chúng tôi.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="pillar-card shadow-lg">
                        <div class="pillar-icon"><i class="fa-solid fa-hat-chef"></i></div>
                        <h4 class="pillar-title">Bậc thầy Chế biến</h4>
                        <p class="pillar-text">Đội ngũ bếp trưởng danh tiếng, những nghệ nhân vị giác thực thụ, biến hóa nguyên liệu thành những kiệt tác nghệ thuật đầy cảm xúc.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <div class="pillar-card shadow-lg">
                        <div class="pillar-icon"><i class="fa-solid fa-crown"></i></div>
                        <h4 class="pillar-title">Dịch vụ Thượng lưu</h4>
                        <p class="pillar-text">Quy trình phục vụ chuẩn hoàng gia 7 sao, được cá nhân hóa hoàn hảo, đảm bảo sự riêng tư và hài lòng tuyệt đối cho mọi thượng khách.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="collections-section">
        <div class="pattern-overlay"></div>
        <div class="container">
            <div class="row g-0 align-items-stretch shadow-lg">
                <div class="col-lg-6" data-aos="slide-right" data-aos-duration="1200">
                    <div class="collection-panel d-flex flex-column justify-content-center text-start">
                        <span class="text-gold text-uppercase small letter-spacing-huge mb-3 d-block">Collections</span>
                        <h3 class="section-title-lux mb-4 cinzel-font" style="font-size: 2.8rem;">Tuyệt phẩm <br> Đặc trưng</h3>
                        <p class="text-white-50 mb-5" style="line-height: 2; font-weight: 300; font-size: 1rem; letter-spacing: 1px;">
                            Khám phá những bộ sưu tập mỹ vị tinh tuyển, được thiết kế để đánh thức mọi giác quan. Mỗi lựa chọn là một hành trình khám phá hương vị độc bản và đầy bất ngờ.
                        </p>
                        <a href="index.php?act=menu" class="btn btn-gold-ultra btn-sm" style="letter-spacing: 3px; padding: 18px 45px;">Xem toàn bộ thực đơn</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="slide-left" data-aos-duration="1200">
                    <div class="p-5 h-100 bg-dark d-flex flex-column justify-content-center border-start border-gold border-4 shadow-inner" style="background-color: var(--slate-gray) !important;">
                        <div class="d-flex flex-column gap-4 px-3">
                            <a href="index.php?act=menu&category_id=1" class="category-link-ultra shadow-lg">
                                <span class="cinzel-font fw-medium text-white">Pizza</span>
                                <i class="fa-solid fa-chevron-right fs-xs text-gold"></i>
                            </a>
                            <a href="index.php?act=menu&category_id=2" class="category-link-ultra shadow-lg">
                                <span class="cinzel-font fw-medium text-white">Burger</span>
                                <i class="fa-solid fa-chevron-right fs-xs text-gold"></i>
                            </a>
                            <a href="index.php?act=menu&category_id=3" class="category-link-ultra shadow-lg">
                                <span class="cinzel-font fw-medium text-white">Đồ uống</span>
                                <i class="fa-solid fa-chevron-right fs-xs text-gold"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="membership-section">
        <div class="container" data-aos="zoom-in" data-aos-duration="1200">
            <div class="membership-card rounded-0 shadow-lg">
                <span class="hero-subtitle mb-4 d-block letter-spacing-huge text-gold cinzel-font" style="font-size: 1.1rem; letter-spacing: 12px;">Elite Privilege</span>
                <h2 class="section-title-lux text-white mb-5 cinzel-font" style="font-size: 3.8rem; letter-spacing: -2px;">Đặc quyền Tinh hoa</h2>
                <div class="section-divider-gold"></div>
                <p class="lead mx-auto mb-5 text-white-50" style="max-width: 700px; font-weight: 200; letter-spacing: 1px; line-height: 1.9;">
                    Gia nhập Câu lạc bộ Elite của Agile Food để tận hưởng những đặc quyền chưa từng có: thực đơn độc quyền, dịch vụ bếp trưởng cá nhân, và ưu tiên phục vụ tuyệt đối. Chúng tôi không chỉ cung cấp dịch vụ; chúng tôi cung cấp một phong cách sống đẳng cấp.
                </p>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <a href="#" class="btn btn-gold-ultra btn-sm">Đăng ký Đặc quyền</a>
                    <a href="#" class="btn btn-outline-gold btn-sm">Tìm hiểu về Elite Club</a>
                </div>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Khởi tạo hiệu ứng AOS khi cuộn trang
  AOS.init({
      easing: 'ease-out-back', // Loại hiệu ứng easing mượt mà
      once: true, // Hiệu ứng chỉ chạy một lần khi cuộn đến
  });

  // Hiệu ứng Parallax mượt mà cho ảnh nền toàn trang
  window.addEventListener('scroll', function() {
      const scrollPos = window.pageYOffset;
      const parallaxBg = document.querySelector('.parallax-bg');
      // Di chuyển ảnh nền cực chậm ngược chiều cuộn chuột
      if (parallaxBg) {
          parallaxBg.style.transform = 'scale(1.1) translateY(' + (scrollPos * 0.08) + 'px)';
      }
  });
</script>

<?php require './views/client/footer.php'; ?>