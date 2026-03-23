<nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">GOURMET <span style="color:white">HAVEN</span></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php?act=home">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?act=gioithieu">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tin Tức</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Danh Mục</a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white" href="#">Món Chính</a></li>
                            <li><a class="dropdown-item text-white" href="#">Đồ Uống</a></li>
                            <li><a class="dropdown-item text-white" href="#">Tráng Miệng</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Món Ăn</a></li>

                </ul>

                <div class="d-flex align-items-center">
                    <a href="#" class="text-white me-4 position-relative">
                        <i class="fa-solid fa-bag-shopping fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">2</span>
                    </a>
                    
                    <span class="text-white me-3" style="font-size: 14px; font-weight: 500;">
                        Xin chào, <span style="color: var(--gold);">
                            <?php 
                                // Dùng tên bên user session (từ DB), fallback về Khách
                                if (isset($_SESSION['user']['name'])) {
                                    echo htmlspecialchars($_SESSION['user']['name']);
                                } elseif (isset($_SESSION['name'])) {
                                    echo htmlspecialchars($_SESSION['name']);
                                } else {
                                    echo 'Khách';
                                }
                            ?>
                        </span>
                    </span>

                    <a href="index.php?act=logout" class="btn btn-gold btn-sm">Đăng Xuất</a>
                </div>
            </div>
        </div>
    </nav>