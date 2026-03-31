</main>

<footer class="footer-full text-white mt-5 pt-5 pb-3 footer-animated">
    <div class="footer-top-border"></div>

    <div class="container py-4">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="mb-3 d-flex align-items-center">
                    <span class="fs-2 me-2">🍕</span>
                    <h3 class="fw-bold mb-0 text-uppercase">
                        AGILE <span class="text-warning">FOOD</span>
                    </h3>
                </div>
                <p class="text-secondary small mb-4 pe-lg-3" style="line-height: 1.8;">
                    Hệ thống đặt món Pizza, Burger và Đồ uống trực tuyến, phù hợp với dữ liệu hiện có của dự án.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <h6 class="fw-bold mb-4 text-uppercase text-warning">Khám phá</h6>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="index.php?act=home" class="footer-link">Trang chủ</a></li>
                    <li class="mb-3"><a href="index.php?act=menu" class="footer-link">Thực đơn</a></li>
                    <li class="mb-3"><a href="index.php?act=posts" class="footer-link">Bài viết</a></li>
                    <li class="mb-3"><a href="index.php?act=cart" class="footer-link">Giỏ hàng</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-4 text-uppercase text-warning">Liên hệ hỗ trợ</h6>
                <div class="small text-secondary mb-4">
                    <p class="mb-2 d-flex align-items-center"><i class="fas fa-map-marker-alt text-warning me-3"></i> Số 1 Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</p>
                    <p class="mb-2 d-flex align-items-center"><i class="fas fa-phone-alt text-warning me-3"></i> 0123 456 789</p>
                    <p class="mb-0 d-flex align-items-center"><i class="fas fa-envelope text-warning me-3"></i> admin@agilefood.local</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
    <h6 class="fw-bold mb-4 text-uppercase text-warning">Bản đồ cửa hàng</h6>
    <div class="map-wrapper shadow-lg overflow-hidden bg-dark" style="height: 200px;">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863931154134!2d105.74421217534438!3d21.038127780613532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x530c49187321503!2zUC4gVHLhu4tuaCBÄƒbiBCw7QsIFh1w6JuIFBoxrDGoW5nLCBOYW0gVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1svi!2s!4v1710315000000!5m2!1svi!2s" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <p class="mt-3 text-secondary small">
        <i class="fas fa-clock text-warning me-2"></i>Mở cửa: 08:00 - 22:00 hằng ngày.
    </p>
</div>

           

        <hr class="my-4 border-secondary opacity-25">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-secondary mb-0">
                    © <?= date('Y') ?> <span class="text-white fw-bold">Agile Food</span>. Dự án Web PHP MVC.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <span class="small text-secondary me-3">Thanh toán an toàn qua:</span>
                <img src="https://img.icons8.com/color/48/000000/visa.png" width="30" class="payment-icon" alt="Visa">
                <img src="https://img.icons8.com/color/48/000000/mastercard.png" width="30" class="payment-icon" alt="Mastercard">
                <img src="https://img.icons8.com/color/48/000000/paypal.png" width="30" class="payment-icon" alt="Paypal">
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-full {
        width: 100%;
        background: #111111;
        position: relative;
        overflow: hidden;
    }

    .footer-top-border {
        height: 3px;
        background: linear-gradient(90deg, transparent, #ffc107, transparent);
        margin-bottom: 2rem;
    }

    .footer-link {
        color: #adb5bd !important;
        text-decoration: none;
        transition: 0.3s;
    }

    .footer-link:hover {
        color: #ffc107 !important;
    }

    .social-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        color: white !important;
        border: 1px solid rgba(255,255,255,0.1);
        transition: 0.3s;
    }

    .social-btn:hover {
        background: #ffc107;
        color: #000 !important;
    }

    .map-wrapper {
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .payment-icon {
        filter: grayscale(1);
        transition: 0.3s;
    }

    .payment-icon:hover {
        filter: grayscale(0);
        transform: translateY(-2px);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNavbar');
        if (nav) {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        }
    });

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            try {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            } catch (e) {}
        });
    }, 5000);
</script>
</body>
</html>