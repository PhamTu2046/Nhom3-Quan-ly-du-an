<?php
// có class chứa các function thực thi xử lý logic 
require_once './models/ProductModel.php';
class ProductController
{
    public $modelProduct;
    public $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
        $this->modelCategory = new CategoryModel();
    }

    public function Home()
    {
        $title = "Đây là trang chủ nhé hahaa";
        $thoiTiet = "Hôm nay trời có vẻ là mưa";
        header("Location: index.php?act=list-product");
        exit;
    }


    public function index() {
        $products = $this->modelProduct->getAll();
        require './views/admin/product/list.php';
    }

    public function create() {
        $categories = $this->modelCategory->getAll();
        require './views/admin/product/add.php';
    }

    public function store() {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];

        $error = [];

        if (empty($name)) $error['name'] = "Tên không được trống";
        if (empty($price)) $error['price'] = "Giá không được trống";
        if (empty($category_id)) $error['category'] = "Chọn danh mục";

        // Xử lý upload ảnh
        $image = null;

        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            $fileName = time() . '_' . $file['name'];

            move_uploaded_file($file['tmp_name'], './uploads/' . $fileName);

            $image = $fileName;
        }

        if (!empty($error)) {
            $categories = $this->modelCategory->getAll();
            require './views/admin/product/add.php';
            return;
        }

        $this->modelProduct->insert($name, $price, $category_id, $description, $image);

        header("Location: index.php?act=list-product");
        exit;
    }

    public function edit() {
        $id = $_GET['id'];
        $product = $this->modelProduct->find($id);
        $categories = $this->modelCategory->getAll();

        require './views/admin/product/edit.php';
    }

    public function update() {
        $id = $_GET['id'];
        $product = $this->modelProduct->find($id);
        $image = $product['image'];

        $name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];

        $error = [];

        if (empty($name)) {
            $error['name'] = "Tên không được trống";
        }

        if (empty($price)) {
            $error['price'] = "Giá không được trống";
        }

        if (empty($category_id)) {
            $error['category'] = "Phải chọn danh mục";
        }

        if (!empty($error)) {
            $product = $this->modelProduct->find($id);
            $categories = $this->modelCategory->getAll();
            require './views/admin/product/edit.php';
            return;
        }

        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            $fileName = time() . '_' . $file['name'];

            move_uploaded_file($file['tmp_name'], './uploads/' . $fileName);

            $image = $fileName;
        }

        $this->modelProduct->update($id, $name, $price, $category_id, $description, $image);

        header("Location: index.php?act=list-product");
        exit;
    }

    public function delete() {
        $this->modelProduct->softDelete($_GET['id']);
        header("Location: index.php?act=list-product");
        exit;
    }

    public function trash() {
        $products = $this->modelProduct->getTrash();
        require './views/admin/product/trash.php';
    }

    public function restore() {
        $this->modelProduct->restore($_GET['id']);
        header("Location: index.php?act=trash-product");
        exit;
    }

    public function forceDelete() {
        $this->modelProduct->forceDelete($_GET['id']);
        header("Location: index.php?act=trash-product");
        exit;
    }
}
