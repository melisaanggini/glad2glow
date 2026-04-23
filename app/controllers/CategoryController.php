<?php
require_once ROOT . '/app/models/Category.php';
require_once ROOT . '/app/models/Product.php';

class CategoryController {
    public function index() {
        $categoryModel = new Category();
        $productModel  = new Product();

        $data['categories'] = $categoryModel->getAll();

        // Filter yang dipilih (cat=ID atau cat=bestseller)
        $data['selected_category'] = null;
        $data['products']          = [];
        $data['active_filter']     = null; // untuk highlight tab aktif

        if (isset($_GET['cat'])) {
            if ($_GET['cat'] === 'bestseller') {
                // Filter Best Seller
                $data['active_filter']     = 'bestseller';
                $data['products']          = $productModel->getBestsellers(12);
                $data['selected_category'] = ['name' => 'Best Seller', 'id' => 'bestseller'];
            } else {
                $catId = (int) $_GET['cat'];
                $data['active_filter']     = $catId;
                $data['selected_category'] = $categoryModel->getById($catId);
                $data['products']          = $productModel->getByCategory($catId);
            }
        }

        require ROOT . '/app/views/category/index.php';
    }
}
