<?php
require_once ROOT . '/app/models/Category.php';
require_once ROOT . '/app/models/Product.php';

class CategoryController {
    public function index() {
        $categoryModel = new Category();
        $productModel  = new Product();

        $data['categories'] = $categoryModel->getAll();

        // If a category filter is selected
        $data['selected_category'] = null;
        $data['products'] = [];
        if (isset($_GET['cat'])) {
            $catId = (int) $_GET['cat'];
            $data['selected_category'] = $categoryModel->getById($catId);
            $data['products'] = $productModel->getByCategory($catId);
        }

        require ROOT . '/app/views/category/index.php';
    }
}
