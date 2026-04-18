<?php require './views/client/layouts/header.php'; ?>

<style>
    .post-detail-hero {
        min-height: 420px;
        background: linear-gradient(180deg, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.85) 100%), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2012&auto=format&fit=crop') center/cover no-repeat;
        color: #fff;
        display: flex;
        align-items: center;
        position: relative;
    }

    .post-detail-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.35);
    }

    .post-detail-hero .hero-content {
        position: relative;
        z-index: 1;
    }

    .post-detail-card {
        background: rgba(0, 0, 0, 0.78);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 0.5rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.45);
    }

    .post-detail-card .post-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .post-detail-meta {
        color: #d4af37;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
    }

    .post-detail-body {
        color: #f8f8f8;
        line-height: 1.8;
    }

    .post-detail-body p {
        margin-bottom: 1.3rem;
    }

    .btn-back-link {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: color 0.25s ease;
    }

    .btn-back-link:hover {
        color: #d4af37;
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4 flex-wrap">
        <div>
            <h1 class="display-6 text-white mb-2"><?= e($post['title']) ?></h1>
            <div class="post-detail-meta mb-3">
                <span><i class="fa-regular fa-calendar-check me-2"></i><?= !empty($post['created_at']) ? e(date('d/m/Y', strtotime($post['created_at']))) : 'N/A' ?></span>
            </div>
        </div>
        <a href="index.php?act=posts" class="btn-back-link">
            <i class="fa-solid fa-arrow-left-long me-2"></i>Quay về Bài viết
        </a>
    </div>

    <div class="card post-detail-card overflow-hidden">
        <?php
            $postImage = !empty($post['image']) ? 'uploads/' . basename($post['image']) : 'https://placehold.co/1200x600/111/D4AF37?text=No+Image';
        ?>
        <img src="<?= e($postImage) ?>" alt="<?= e($post['title']) ?>" class="post-image">

        <div class="card-body post-detail-body p-4 p-lg-5">
            <?= nl2br(e($post['content'])) ?>
        </div>
    </div>
</div>

<?php require './views/client/layouts/footer.php'; ?>
