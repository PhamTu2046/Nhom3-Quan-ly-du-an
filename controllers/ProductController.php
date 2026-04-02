<?php
require_once './models/ProductModel.php';

class ProductController
{
    public $modelProduct;
    public $modelCategory;
    public $modelCart;
    public $modelOrder;
    public $modelUser;
    public $modelPost;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
        $this->modelCategory = new CategoryModel();
        $this->modelCart = new CartModel();
        $this->modelOrder = new OrderModel();
        $this->modelUser = new UserModel();
        $this->modelPost = new PostModel();
    }

    private function requireLogin()
    {
        if (!isLoggedIn()) {
            setFlash('error', 'Vui lòng đăng nhập để tiếp tục.');
            redirect('login');
        }
    }

    private function requireCustomer()
    {
        $this->requireLogin();

        if (($_SESSION['user']['role'] ?? '') !== 'customer') {
            setFlash('error', 'Chức năng này dành cho khách hàng.');
            redirect(isAdmin() ? 'admin' : 'home');
        }
    }

    private function requireAdmin()
    {
        $this->requireLogin();

        if (!isAdmin()) {
            setFlash('error', 'Bạn không có quyền truy cập khu vực quản trị.');
            redirect('home');
        }
    }

    private function currentUserId()
    {
        return (int) ($_SESSION['user']['id'] ?? 0);
    }

    private function uploadImage($fieldName, $currentImage = null)
    {
        if (empty($_FILES[$fieldName]['name'])) {
            return $currentImage;
        }

        $uploadedPath = uploadFile($_FILES[$fieldName], 'uploads');

        if ($uploadedPath) {
            if (!empty($currentImage)) {
                deleteFile('uploads/' . basename($currentImage));
            }

            return basename($uploadedPath);
        }

        return $currentImage;
    }

    private function calculateCartTotal(array $cartItems)
    {
        return array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function Home()
    {
        $keyword = trim($_GET['keyword'] ?? '');
        $categoryId = (int) ($_GET['category_id'] ?? 0);

        $allProducts = $this->modelProduct->getFiltered($keyword, $categoryId);
        $products = array_slice($allProducts, 0, 3);
        $categories = $this->modelCategory->getAll();
        $posts = $this->modelPost->getLatest(3);
        $cartCount = isLoggedIn() && !isAdmin() ? $this->modelCart->countItems($this->currentUserId()) : 0;
        $pageTitle = 'Trang chủ';

        require './views/client/home.php';
    }

    public function about()
    {
        $stats = [
            'products' => $this->modelProduct->countAll(),
            'categories' => $this->modelCategory->countAll(),
            'customers' => $this->modelUser->countCustomers(),
            'orders' => $this->modelOrder->countAll(),
        ];
        $cartCount = isLoggedIn() && !isAdmin() ? $this->modelCart->countItems($this->currentUserId()) : 0;
        $pageTitle = 'Giới thiệu';

        require './views/client/about.php';
    }

    public function posts()
    {
        $posts = $this->modelPost->getLatest(20);
        $cartCount = isLoggedIn() && !isAdmin() ? $this->modelCart->countItems($this->currentUserId()) : 0;
        $pageTitle = 'Bài viết';

        require './views/client/posts.php';
    }

    public function menu()
    {
        $keyword = trim($_GET['keyword'] ?? '');
        $categoryId = (int) ($_GET['category_id'] ?? 0);

        $products = $this->modelProduct->getFiltered($keyword, $categoryId);
        $categories = $this->modelCategory->getAll();
        $cartCount = isLoggedIn() && !isAdmin() ? $this->modelCart->countItems($this->currentUserId()) : 0;
        $pageTitle = 'Thực đơn';

        require './views/client/menu.php';
    }

    public function show()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $product = $this->modelProduct->findActive($id);

        if (!$product) {
            setFlash('error', 'Sản phẩm không tồn tại hoặc đã bị gỡ.');
            redirect('home');
        }

        $relatedProducts = $this->modelProduct->getRelated((int) $product['category_id'], $id);
        $cartCount = isLoggedIn() && !isAdmin() ? $this->modelCart->countItems($this->currentUserId()) : 0;
        $pageTitle = $product['name'];

        require './views/client/product-detail.php';
    }

    public function cart()
    {
        $this->requireCustomer();

        $cartItems = $this->modelCart->getByUserId($this->currentUserId());
        $cartTotal = $this->calculateCartTotal($cartItems);
        $cartCount = $this->modelCart->countItems($this->currentUserId());
        $pageTitle = 'Giỏ hàng';

        require './views/client/cart.php';
    }

    public function addToCart()
    {
        $this->requireCustomer();

        $productId = (int) ($_GET['id'] ?? $_POST['product_id'] ?? 0);
        $quantity = max(1, (int) ($_POST['quantity'] ?? 1));
        $product = $this->modelProduct->findActive($productId);

        if (!$product) {
            setFlash('error', 'Không tìm thấy sản phẩm để thêm vào giỏ.');
            redirect('home');
        }

        $this->modelCart->addOrIncrement($this->currentUserId(), $productId, $quantity);
        setFlash('success', 'Đã thêm sản phẩm vào giỏ hàng.');

        $backUrl = $_SERVER['HTTP_REFERER'] ?? 'index.php?act=home';
        header('Location: ' . $backUrl);
        exit();
    }

    public function updateCart()
    {
        $this->requireCustomer();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach (($_POST['quantities'] ?? []) as $cartId => $quantity) {
                $this->modelCart->updateQuantity((int) $cartId, $this->currentUserId(), (int) $quantity);
            }
        }

        setFlash('success', 'Giỏ hàng đã được cập nhật.');
        redirect('cart');
    }

    public function removeCartItem()
    {
        $this->requireCustomer();

        $cartId = (int) ($_GET['id'] ?? 0);
        $this->modelCart->deleteItem($cartId, $this->currentUserId());

        setFlash('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
        redirect('cart');
    }

    public function checkout()
    {
        $this->requireCustomer();

        $cartItems = $this->modelCart->getByUserId($this->currentUserId());
        if (empty($cartItems)) {
            setFlash('error', 'Giỏ hàng đang trống. Vui lòng chọn sản phẩm trước khi thanh toán.');
            redirect('home');
        }

        $cartTotal = $this->calculateCartTotal($cartItems);
        $cartCount = $this->modelCart->countItems($this->currentUserId());
        $pageTitle = 'Thanh toán';

        require './views/client/checkout.php';
    }

    public function placeOrder()
    {
        $this->requireCustomer();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('checkout');
        }

        $cartItems = $this->modelCart->getByUserId($this->currentUserId());
        if (empty($cartItems)) {
            setFlash('error', 'Giỏ hàng không còn sản phẩm hợp lệ.');
            redirect('home');
        }

        $paymentMethod = $_POST['payment_method'] ?? 'cod';
        if (!in_array($paymentMethod, ['cod', 'online'], true)) {
            $paymentMethod = 'cod';
        }

        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        if ($phone !== '' || $address !== '') {
            $this->modelUser->updateContact($this->currentUserId(), $phone, $address);
            $_SESSION['user']['phone'] = $phone;
            $_SESSION['user']['address'] = $address;
        }

        $cartTotal = $this->calculateCartTotal($cartItems);

        try {
            $this->modelOrder->createOrder($this->currentUserId(), $cartTotal, $paymentMethod, $cartItems);
            setFlash('success', 'Đặt hàng thành công. Bạn có thể theo dõi trạng thái đơn ngay bên dưới.');
            redirect('my-orders');
        } catch (Throwable $exception) {
            setFlash('error', 'Không thể tạo đơn hàng lúc này. Vui lòng thử lại.');
            redirect('checkout');
        }
    }

    public function myOrders()
    {
        $this->requireCustomer();

        $orders = $this->modelOrder->getByUserId($this->currentUserId());
        $cartCount = $this->modelCart->countItems($this->currentUserId());
        $pageTitle = 'Đơn hàng của tôi';

        require './views/client/orders.php';
    }

    public function dashboard()
    {
        $this->requireAdmin();

        $stats = [
            'products' => $this->modelProduct->countAll(),
            'categories' => $this->modelCategory->countAll(),
            'orders' => $this->modelOrder->countAll(),
            'pending_orders' => $this->modelOrder->countPending(),
            'customers' => $this->modelUser->countCustomers(),
            'revenue' => $this->modelOrder->getRevenue(),
            'posts' => $this->modelPost->countAll(),
        ];

        $recentOrders = $this->modelOrder->getAll(6);
        $users = $this->modelUser->getAll(6);
        $categories = $this->modelCategory->getAll();
        $posts = $this->modelPost->getLatest(5);
        $pageTitle = 'Dashboard quản trị';

        require './views/admin/index.php';
    }

    public function index()
    {
        $this->requireAdmin();

        $products = $this->modelProduct->getAll();
        $pageTitle = 'Quản lý sản phẩm';

        require './views/admin/product/list.php';
    }

    public function create()
    {
        $this->requireAdmin();

        $categories = $this->modelCategory->getAll();
        $pageTitle = 'Thêm sản phẩm';

        require './views/admin/product/add.php';
    }

    public function store()
    {
        $this->requireAdmin();

        $name = trim($_POST['name'] ?? '');
        $rawPrice = trim($_POST['price'] ?? '');
        $price = is_numeric($rawPrice) ? (float) $rawPrice : -1;
        $categoryId = (int) ($_POST['category_id'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        $maxPrice = 99999999.99;
        $error = [];

        if ($name === '') {
            $error['name'] = 'Tên sản phẩm không được để trống';
        }
        if ($rawPrice === '' || $price <= 0) {
            $error['price'] = 'Giá sản phẩm phải lớn hơn 0';
        } elseif ($price > $maxPrice) {
            $error['price'] = 'Giá sản phẩm không được vượt quá 99.999.999 đ';
        }
        if ($categoryId <= 0) {
            $error['category'] = 'Vui lòng chọn danh mục';
        }

        if (!empty($error)) {
            $categories = $this->modelCategory->getAll();
            $pageTitle = 'Thêm sản phẩm';
            require './views/admin/product/add.php';
            return;
        }

        try {
            $image = $this->uploadImage('image');
            $this->modelProduct->insert($name, $price, $categoryId, $description, $image);

            setFlash('success', 'Đã thêm sản phẩm mới thành công.');
            redirect('list-product');
        } catch (PDOException $exception) {
            $error['general'] = 'Không thể lưu sản phẩm. Vui lòng kiểm tra lại dữ liệu, đặc biệt là giá bán.';
            $categories = $this->modelCategory->getAll();
            $pageTitle = 'Thêm sản phẩm';
            require './views/admin/product/add.php';
        }
    }

    public function edit()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $product = $this->modelProduct->find($id);

        if (!$product) {
            setFlash('error', 'Không tìm thấy sản phẩm cần chỉnh sửa.');
            redirect('list-product');
        }

        $categories = $this->modelCategory->getAll();
        $pageTitle = 'Cập nhật sản phẩm';

        require './views/admin/product/edit.php';
    }

    public function update()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $product = $this->modelProduct->find($id);

        if (!$product) {
            setFlash('error', 'Sản phẩm không tồn tại.');
            redirect('list-product');
        }

        $name = trim($_POST['name'] ?? '');
        $rawPrice = trim($_POST['price'] ?? '');
        $price = is_numeric($rawPrice) ? (float) $rawPrice : -1;
        $categoryId = (int) ($_POST['category_id'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        $maxPrice = 99999999.99;
        $error = [];

        if ($name === '') {
            $error['name'] = 'Tên sản phẩm không được để trống';
        }
        if ($rawPrice === '' || $price <= 0) {
            $error['price'] = 'Giá sản phẩm phải lớn hơn 0';
        } elseif ($price > $maxPrice) {
            $error['price'] = 'Giá sản phẩm không được vượt quá 99.999.999 đ';
        }
        if ($categoryId <= 0) {
            $error['category'] = 'Vui lòng chọn danh mục';
        }

        if (!empty($error)) {
            $categories = $this->modelCategory->getAll();
            $pageTitle = 'Cập nhật sản phẩm';
            require './views/admin/product/edit.php';
            return;
        }

        try {
            $image = $this->uploadImage('image', $product['image'] ?? null);
            $this->modelProduct->update($id, $name, $price, $categoryId, $description, $image);

            setFlash('success', 'Sản phẩm đã được cập nhật.');
            redirect('list-product');
        } catch (PDOException $exception) {
            $error['general'] = 'Không thể cập nhật sản phẩm. Vui lòng kiểm tra lại dữ liệu, đặc biệt là giá bán.';
            $categories = $this->modelCategory->getAll();
            $pageTitle = 'Cập nhật sản phẩm';
            require './views/admin/product/edit.php';
        }
    }

    public function delete()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $this->modelProduct->softDelete($id);

        setFlash('success', 'Sản phẩm đã được chuyển vào thùng rác.');
        redirect('list-product');
    }

    public function trash()
    {
        $this->requireAdmin();

        $products = $this->modelProduct->getTrash();
        $pageTitle = 'Thùng rác sản phẩm';

        require './views/admin/product/trash.php';
    }

    public function restore()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $this->modelProduct->restore($id);

        setFlash('success', 'Đã khôi phục sản phẩm.');
        redirect('trash-product');
    }

    public function forceDelete()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $product = $this->modelProduct->find($id);

        if ($product && !empty($product['image'])) {
            deleteFile('uploads/' . basename($product['image']));
        }

        $this->modelProduct->forceDelete($id);

        setFlash('success', 'Đã xóa vĩnh viễn sản phẩm.');
        redirect('trash-product');
    }

    public function adminOrders()
    {
        $this->requireAdmin();

        $orders = $this->modelOrder->getAll();
        $pageTitle = 'Quản lý đơn hàng';

        require './views/admin/order/list.php';
    }

    public function updateOrderStatus()
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = (int) ($_POST['order_id'] ?? 0);
            $status = $_POST['status'] ?? 'pending';

            if (in_array($status, ['pending', 'processing', 'completed', 'cancelled'], true)) {
                $this->modelOrder->updateStatus($orderId, $status);
                setFlash('success', 'Cập nhật trạng thái đơn hàng thành công.');
            } else {
                setFlash('error', 'Trạng thái đơn hàng không hợp lệ.');
            }
        }

        redirect('admin-orders');
    }

    public function adminUsers()
    {
        $this->requireAdmin();

        $users = $this->modelUser->getAll();
        $pageTitle = 'Danh sách người dùng';

        require './views/admin/user/list.php';
    }

    public function adminCategories()
    {
        $this->requireAdmin();

        $categories = $this->modelCategory->getAll();
        $editingCategory = null;

        if (!empty($_GET['id'])) {
            $editingCategory = $this->modelCategory->find((int) $_GET['id']);
        }

        $pageTitle = 'Quản lý danh mục';
        require './views/admin/category/list.php';
    }

    public function saveCategory()
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin-categories');
        }

        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '') {
            setFlash('error', 'Tên danh mục không được để trống.');
            redirect('admin-categories' . ($id > 0 ? '&id=' . $id : ''));
        }

        if ($id > 0) {
            $this->modelCategory->update($id, $name, $description);
            setFlash('success', 'Đã cập nhật danh mục thành công.');
        } else {
            $this->modelCategory->create($name, $description);
            setFlash('success', 'Đã thêm danh mục mới.');
        }

        redirect('admin-categories');
    }

    public function deleteCategory()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);

        if ($this->modelProduct->countByCategory($id) > 0) {
            setFlash('error', 'Danh mục đang có sản phẩm, không thể xóa.');
            redirect('admin-categories');
        }

        $this->modelCategory->delete($id);
        setFlash('success', 'Đã xóa danh mục.');
        redirect('admin-categories');
    }

    public function adminPosts()
    {
        $this->requireAdmin();

        $posts = $this->modelPost->getAll();
        $pageTitle = 'Quản lý bài viết';

        require './views/admin/post/list.php';
    }

    public function createPost()
    {
        $this->requireAdmin();

        $pageTitle = 'Thêm bài viết';
        require './views/admin/post/add.php';
    }

    public function storePost()
    {
        $this->requireAdmin();

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $error = [];

        if ($title === '') {
            $error['title'] = 'Tiêu đề bài viết không được để trống';
        }
        if ($content === '') {
            $error['content'] = 'Nội dung bài viết không được để trống';
        }

        if (!empty($error)) {
            $pageTitle = 'Thêm bài viết';
            require './views/admin/post/add.php';
            return;
        }

        $image = $this->uploadImage('image');
        $this->modelPost->create($title, $content, $image);

        setFlash('success', 'Đã thêm bài viết mới.');
        redirect('admin-posts');
    }

    public function editPost()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $post = $this->modelPost->find($id);

        if (!$post) {
            setFlash('error', 'Không tìm thấy bài viết cần sửa.');
            redirect('admin-posts');
        }

        $pageTitle = 'Cập nhật bài viết';
        require './views/admin/post/edit.php';
    }

    public function updatePost()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $post = $this->modelPost->find($id);

        if (!$post) {
            setFlash('error', 'Bài viết không tồn tại.');
            redirect('admin-posts');
        }

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $error = [];

        if ($title === '') {
            $error['title'] = 'Tiêu đề bài viết không được để trống';
        }
        if ($content === '') {
            $error['content'] = 'Nội dung bài viết không được để trống';
        }

        if (!empty($error)) {
            $pageTitle = 'Cập nhật bài viết';
            require './views/admin/post/edit.php';
            return;
        }

        $image = $this->uploadImage('image', $post['image'] ?? null);
        $this->modelPost->update($id, $title, $content, $image);

        setFlash('success', 'Đã cập nhật bài viết.');
        redirect('admin-posts');
    }

    public function deletePost()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $this->modelPost->delete($id);

        setFlash('success', 'Bài viết đã được chuyển vào thùng rác.');
        redirect('admin-posts');
    }

    public function trashPost()
    {
        $this->requireAdmin();

        $posts = $this->modelPost->getTrash();
        $pageTitle = 'Thùng rác bài viết';

        require './views/admin/post/trash.php';
    }

    public function restorePost()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $this->modelPost->restore($id);

        setFlash('success', 'Đã khôi phục bài viết.');
        redirect('trash-post');
    }

    public function forceDeletePost()
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $post = $this->modelPost->find($id);

        if ($post && !empty($post['image'])) {
            deleteFile('uploads/' . basename($post['image']));
        }

        $this->modelPost->forceDelete($id);

        setFlash('success', 'Đã xóa vĩnh viễn bài viết.');
        redirect('trash-post');
    }
}
