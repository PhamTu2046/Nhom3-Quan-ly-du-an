<?php
require_once './models/CategoryModel.php';

class CategoryController
{
    public $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->modelCategory->getAll();
        require './views/admin/category/list.php';
    }

    public function create()
    {
        require './views/admin/category/add.php';
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');
        $error = [];

        if (empty($name)) {
            $error['name'] = 'Tên danh mục không được để trống';
        }

        if (!empty($error)) {
            require './views/admin/category/add.php';
            return;
        }

        $this->modelCategory->insert($name);
        header('Location: index.php?act=list-category');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?act=list-category');
            exit;
        }

        $category = $this->modelCategory->find($id);
        if (!$category) {
            header('Location: index.php?act=list-category');
            exit;
        }

        require './views/admin/category/edit.php';
    }

    public function update()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?act=list-category');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $error = [];

        if (empty($name)) {
            $error['name'] = 'Tên danh mục không được để trống';
        }

        $category = $this->modelCategory->find($id);
        if (!$category) {
            header('Location: index.php?act=list-category');
            exit;
        }

        if (!empty($error)) {
            require './views/admin/category/edit.php';
            return;
        }

        $this->modelCategory->update($id, $name);
        header('Location: index.php?act=list-category');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelCategory->delete($id);
        }
        header('Location: index.php?act=list-category');
        exit;
    }
}
