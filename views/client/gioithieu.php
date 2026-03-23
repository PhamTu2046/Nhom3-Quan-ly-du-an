<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu Đội Ngũ | Gourmet Haven</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
       :root {
            --gold: #C5A059;
            --dark: #0F0F0F;
            --dark-light: #1A1A1A;
            --white: #FFFFFF;
        }

        body {
            background-color: var(--dark);
            color: var(--white);
            font-family: 'Montserrat', sans-serif;
        }

        h1, h2, h3, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }
         .navbar {
            background-color: rgba(15, 15, 15, 0.95);
            border-bottom: 1px solid rgba(197, 160, 89, 0.2);
            padding: 20px 0;
        }

        .navbar-brand {
            color: var(--gold) !important;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            margin: 0 15px;
            transition: 0.3s;
            text-transform: uppercase;
            font-size: 13px;
        }

        .nav-link:hover {
            color: var(--gold) !important;
        }


        /* --- Phong cách Tạp chí Cao cấp cho Team --- */
        .luxury-team-section {
            background-color: var(--dark);
            padding: 80px 0;
        }

        /* Khung ảnh với viền lệch (Offset Border) */
        .img-offset-wrapper {
            position: relative;
            z-index: 1;
            margin-bottom: 40px;
        }

        .img-offset-wrapper::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid var(--gold);
            z-index: -1;
            transition: all 0.5s ease;
        }

        /* Thiết lập độ lệch của viền */
        .offset-right::before { top: 20px; left: -20px; }
        .offset-left::before { top: 20px; right: -20px; }

        .img-offset-wrapper img {
            width: 100%;
            height: 550px;
            object-fit: cover;
            filter: grayscale(40%) contrast(110%);
            transition: all 0.5s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* Hiệu ứng khi di chuột vào ảnh */
        .img-offset-wrapper:hover img {
            filter: grayscale(0%) contrast(100%);
            transform: translate(-10px, -10px);
        }
        .img-offset-wrapper:hover::before {
            transform: translate(10px, 10px);
        }
        .offset-left:hover img { transform: translate(10px, -10px); }
        .offset-left:hover::before { transform: translate(-10px, 10px); }

        /* Hộp thông tin (Info Box) */
        .luxury-info-box {
            background: rgba(26, 26, 26, 0.95);
            padding: 50px 40px;
            position: relative;
            z-index: 2;
            border-top: 3px solid var(--gold);
            box-shadow: 0 20px 40px rgba(0,0,0,0.8);
        }

        /* Thiết lập xếp chồng (Overlap) trên màn hình máy tính */
        @media (min-width: 992px) {
            .overlap-left { margin-left: -80px; margin-top: 50px; }
            .overlap-right { margin-right: -80px; margin-top: 50px; }
            .img-offset-wrapper { margin-bottom: 0; }
        }

        /* Typography riêng cho phần giới thiệu */
        .chef-quote {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--gold);
            font-style: italic;
            margin-bottom: 25px;
            line-height: 1.5;
            position: relative;
        }

        .chef-quote::before { 
            content: "“"; 
            font-size: 3rem; 
            position: absolute; 
            top: -15px; 
            left: -15px; 
            opacity: 0.2; 
            color: var(--gold); 
        }
 .btn-gold {
            background-color: var(--gold);
            color: var(--dark);
            padding: 12px 35px;
            border-radius: 0;
            font-weight: 600;
            border: 2px solid var(--gold);
            transition: 0.4s;
        }

        .btn-gold:hover {
            background-color: transparent;
            color: var(--gold);
        }
        .chef-name { font-size: 2.8rem; margin-bottom: 5px; color: var(--white); }
        
        .chef-role {
            font-size: 0.85rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 25px;
            display: block;
        }

        .chef-bio {
            color: #bbb;
            line-height: 1.9;
            font-size: 0.95rem;
            text-align: justify;
            margin-bottom: 25px;
        }

        .luxury-list { list-style: none; padding: 0; }
        .luxury-list li { margin-bottom: 12px; color: var(--white); font-size: 0.9rem; display: flex; align-items: baseline; }
        .luxury-list i { color: var(--gold); margin-right: 15px; font-size: 0.8rem; }
    </style>
</head>
<body>

    <?php require __DIR__ . '/layouts/header.php'; ?>

    <section class="luxury-team-section" id="team">
        <div class="container">
            
            <div class="text-center mb-5 pb-4 mt-4">
                <p class="text-uppercase mb-2" style="letter-spacing: 4px; color: var(--gold); font-size: 14px;">Tinh Hoa Hội Tụ</p>
                <h2 class="section-title" style="font-size: 3rem; letter-spacing: 2px;">Giới Tinh Hoa Ẩm Thực</h2>
                <div style="width: 50px; height: 2px; background-color: var(--gold); margin: 20px auto;"></div>
                <p class="text-secondary mx-auto" style="max-width: 600px; font-size: 0.95rem; line-height: 1.8;">
                    Gourmet Haven không chỉ là một nhà hàng, mà là một hành trình nghệ thuật. Đứng sau mỗi món ăn hoàn mỹ, mỗi trải nghiệm thượng lưu là tâm huyết của bốn chuyên gia hàng đầu.
                </p>
            </div>

            <div class="row align-items-center mb-5 pb-5">
                <div class="col-lg-6">
                    <div class="img-offset-wrapper offset-right">
                        <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=800&q=80" alt="Executive Chef Thiện">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="luxury-info-box overlap-left">
                        <p class="chef-quote">Nấu ăn không phải là công thức, đó là cách chúng ta kể những câu chuyện bằng các giác quan.</p>
                        <h3 class="chef-name">Nguyễn Thiện</h3>
                        <span class="chef-role">Founder / Executive Chef</span>
                        <p class="chef-bio">
                            Trở về từ kinh đô ánh sáng Paris sau 12 năm cống hiến tại các nhà hàng 3 sao Michelin, Chef Thiện mang theo triết lý "Ẩm thực Vị lai". Anh kết hợp hoàn hảo giữa kỹ thuật Gastronomy (Ẩm thực phân tử) tiên tiến nhất của phương Tây và linh hồn nguyên bản của các loại gia vị đặc hữu Việt Nam. Mỗi đĩa thức ăn qua tay anh là một tác phẩm điêu khắc vi tế.
                        </p>
                        <ul class="luxury-list">
                            <li><i class="fas fa-gem"></i> Cựu Bếp phó tại L'Arpège (Paris, Pháp).</li>
                            <li><i class="fas fa-gem"></i> Quán quân "Bếp Trưởng Vàng Châu Á 2024".</li>
                            <li><i class="fas fa-gem"></i> Chuyên gia thiết kế Thực đơn đa giác quan (Multi-sensory Menu).</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-5 pb-5 flex-lg-row-reverse">
                <div class="col-lg-6">
                    <div class="img-offset-wrapper offset-left">
                        <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80" alt="Sommelier Tú">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="luxury-info-box overlap-right">
                        <p class="chef-quote">Mỗi chai vang là một dòng chảy của lịch sử, văn hóa và thời gian được đóng gói cẩn thận.</p>
                        <h3 class="chef-name">Trần Tú</h3>
                        <span class="chef-role">Co-Founder / Head Sommelier</span>
                        <p class="chef-bio">
                            Tú là một trong ba người Việt Nam hiếm hoi sở hữu chứng chỉ danh giá WSET Level 4 Diploma. Bằng sự nhạy bén thiên bẩm về khứu giác và kiến thức uyên thâm về thổ nhưỡng, anh đã đích thân thu thập hơn 800 nhãn vang quý hiếm trên toàn cầu. Trải nghiệm Food & Wine Pairing do Tú tư vấn luôn là mảnh ghép hoàn hảo, đánh thức mọi dải hương vị tinh tế nhất.
                        </p>
                        <ul class="luxury-list">
                            <li><i class="fas fa-wine-glass-alt"></i> Sở hữu WSET Level 4 Diploma in Wines.</li>
                            <li><i class="fas fa-wine-glass-alt"></i> Giám khảo các cuộc thi thử nếm rượu vang quốc tế.</li>
                            <li><i class="fas fa-wine-glass-alt"></i> Quản lý hầm rượu vang độc quyền trị giá 2 triệu USD.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-5 pb-5">
                <div class="col-lg-6">
                    <div class="img-offset-wrapper offset-right">
                        <img src="https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?auto=format&fit=crop&w=800&q=80" alt="General Manager Hùng">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="luxury-info-box overlap-left">
                        <p class="chef-quote">Sự hoàn hảo không đến từ sự xa hoa phô trương, mà đến từ sự thấu hiểu khách hàng.</p>
                        <h3 class="chef-name">Lê Hùng</h3>
                        <span class="chef-role">General Manager</span>
                        <p class="chef-bio">
                            Từng là Giám đốc Ẩm thực tại chuỗi nghỉ dưỡng 6 sao Aman, Hùng là "nhạc trưởng" thiết lập nên chuẩn mực dịch vụ tại Gourmet Haven. Với triết lý "Invisible Service" (Dịch vụ vô hình), đội ngũ của anh luôn xuất hiện đúng lúc khách hàng cần và lùi lại để nhường không gian riêng tư. Mọi chi tiết từ nhiệt độ phòng, ánh sáng đến loại hoa trên bàn đều được Hùng kiểm soát bằng sự tỉ mỉ tột độ.
                        </p>
                        <ul class="luxury-list">
                            <li><i class="fas fa-concierge-bell"></i> Thạc sĩ Quản trị Khách sạn tại Glion (Thụy Sĩ).</li>
                            <li><i class="fas fa-concierge-bell"></i> Sáng lập hệ thống chuẩn mực dịch vụ "Sliver Service" độc quyền.</li>
                            <li><i class="fas fa-concierge-bell"></i> Quản lý hệ thống khách hàng VIP và thẻ hội viên Black Card.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="img-offset-wrapper offset-left">
                        <img src="https://images.unsplash.com/photo-1566554273541-37a9ca77b91f?auto=format&fit=crop&w=800&q=80" alt="Sous Chef Tuân">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="luxury-info-box overlap-right">
                        <p class="chef-quote">Đồ ngọt không chỉ để tráng miệng, nó là lời cảm ơn ngọt ngào nhất để khép lại một ký ức đẹp.</p>
                        <h3 class="chef-name">Phạm Tuân</h3>
                        <span class="chef-role">Sous Chef / Pastry Master</span>
                        <p class="chef-bio">
                            Là một nghệ nhân thực thụ trong thế giới đồ ngọt, Tuân coi đường, bơ và chocolate là đất sét để tạo nên những tác phẩm điêu khắc ăn được. Tu nghiệp nhiều năm tại Vienna (Áo) - cái nôi của bánh ngọt thế giới, anh liên tục phá vỡ các giới hạn vật lý để tạo ra những món tráng miệng kết hợp cả nhiệt độ, khói lạnh và hiệu ứng thị giác bùng nổ ngay trên bàn ăn.
                        </p>
                        <ul class="luxury-list">
                            <li><i class="fas fa-leaf"></i> Nghệ nhân điêu khắc đường (Sugar Craft) hàng đầu Việt Nam.</li>
                            <li><i class="fas fa-leaf"></i> Chuyên gia chế tác Chocolate thủ công (Artisan Confectioner).</li>
                            <li><i class="fas fa-leaf"></i> Cánh tay phải đắc lực, kiểm soát 100% chất lượng trước khi phục vụ.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php require __DIR__ . '/layouts/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>