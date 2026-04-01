<?php require './views/client/layouts/header.php'; ?>

<style>
    /* --- HỆ THỐNG BIẾN LUXURY --- */
    :root {
        --lux-gold: #D4AF37;
        --lux-gold-light: #F1D38A;
        --glass-dark: rgba(10, 10, 10, 0.85);
        --border-gold: rgba(212, 175, 55, 0.2);
    }

    body {
        background-color: #000 !important;
        color: #fff !important;
        position: relative;
    }

    /* --- LỚP NỀN HÌNH ẢNH --- */
    .master-bg {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://images.unsplash.com/photo-1473093226795-af9932fe5856?q=80&w=2012&auto=format&fit=crop'); 
        background-size: cover;
        background-position: center;
        filter: brightness(0.2) blur(4px);
        z-index: -1;
    }

    /* --- TIÊU ĐỀ --- */
    .lux-page-title {
        font-family: 'Cinzel', serif;
        color: var(--lux-gold);
        letter-spacing: 4px;
        text-transform: uppercase;
        font-weight: 700;
        text-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
    }

    /* --- CARD BÀI VIẾT (ELITE POST CARD) --- */
    .post-vault-card {
        background: var(--glass-dark) !important;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-gold) !important;
        border-radius: 0 !important;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        height: 100%;
        position: relative;
    }

    .post-vault-card:hover {
        transform: translateY(-10px);
        border-color: var(--lux-gold) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.8);
    }

    /* Hiệu ứng khung ảnh */
    .post-img-wrapper {
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid var(--border-gold);
    }

    .post-img-wrapper img {
        transition: transform 1.5s ease;
    }

    .post-vault-card:hover .post-img-wrapper img {
        transform: scale(1.1);
    }

    /* Lớp phủ Gradient lên ảnh */
    .post-img-overlay {
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 50%;
        background: linear-gradient(to top, rgba(10,10,10,0.9), transparent);
    }

    /* --- NỘI DUNG --- */
    .post-title {
        font-family: 'Cinzel', serif;
        color: #fff;
        font-weight: 700;
        transition: 0.3s;
        line-height: 1.4;
    }

    .post-vault-card:hover .post-title {
        color: var(--lux-gold-light);
    }

    .post-meta {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--lux-gold);
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    .btn-lux-read {
        background: transparent;
        color: var(--lux-gold) !important;
        border: 1px solid var(--lux-gold) !important;
        border-radius: 0;
        font-size: 0.7rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 8px 15px;
        transition: 0.4s;
        margin-top: auto;
        align-self: flex-start;
    }

    .btn-lux-read:hover {
        background: var(--lux-gold) !important;
        color: #000 !important;
    }

    .btn-back {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: var(--lux-gold);
    }
</style>

<div class="master-bg"></div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-4 border-bottom border-secondary pb-4 animate__animated animate__fadeIn">
        <div>
            <h1 class="lux-page-title mb-2">Thánh Đường Ký Sự</h1>
            <p class="text-muted mb-0" style="font-style: italic;">"Khám phá những câu chuyện ẩm thực và tin tức độc quyền."</p>
        </div>
        <a href="index.php?act=home" class="btn-back">
            <i class="fa-solid fa-arrow-left-long me-2"></i> Trở về Dinh Thự
        </a>
    </div>

    <?php if (empty($posts)): ?>
        <div class="post-vault-card p-5 text-center animate__animated animate__fadeInUp">
            <div class="py-5">
                <i class="fa-solid fa-feather-pointed fs-1 mb-4 text-secondary opacity-25"></i>
                <h4 class="lux-page-title">Trang sách đang chờ được viết...</h4>
                <p class="text-muted mb-4">Hiện tại chưa có bài viết nào được xuất bản trong thư viện của Thánh Đường.</p>
                <a href="index.php?act=menu" class="btn-lux-read px-4 py-2">Xem thực đơn ngay</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-5">
            <?php foreach ($posts as $index => $post): ?>
                <?php
                    $postImage = !empty($post['image']) ? 'uploads/' . basename($post['image']) : 'https://placehold.co/800x500/111/D4AF37?text=Gourmet+Post';
                    $content = $post['content'] ?: 'Nội dung đang được cập nhật.';
                    $shortContent = mb_strlen($content, 'UTF-8') > 150 ? mb_substr($content, 0, 150, 'UTF-8') . '...' : $content;
                ?>
                <div class="col-md-6 col-xl-4 animate__animated animate__fadeInUp" style="animation-delay: <?= $index * 0.1 ?>s">
                    <div class="card post-vault-card">
                        <div class="post-img-wrapper">
                            <img src="<?= e($postImage) ?>" class="card-img-top" alt="<?= e($post['title']) ?>" style="height: 240px; object-fit: cover;">
                            <div class="post-img-overlay"></div>
                        </div>
                        
                        <div class="card-body d-flex flex-column p-4">
                            <div class="post-meta d-flex justify-content-between align-items-center">
                                <span><i class="fa-regular fa-calendar-check me-2"></i><?= !empty($post['created_at']) ? e(date('d/m/Y', strtotime($post['created_at']))) : 'N/A' ?></span>
                                <span>TIN TỨC ELITE</span>
                            </div>
                            
                            <h5 class="post-title h4 mb-3"><?= e($post['title']) ?></h5>
                            
                            <p class="text-secondary small mb-4" style="line-height: 1.8;">
                                <?= e($shortContent) ?>
                            </p>
                            
                            <a href="#" class="btn-lux-read">Đọc chi tiết <i class="fa-solid fa-chevron-right ms-1" style="font-size: 0.6rem;"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require './views/client/layouts/footer.php'; ?>