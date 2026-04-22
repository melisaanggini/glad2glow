<?php
require_once ROOT . '/app/models/Product.php';
require_once ROOT . '/app/models/Category.php';

class HomeController {
    public function index() {
        $productModel  = new Product();
        $categoryModel = new Category();

        $data['bestsellers'] = $productModel->getBestsellers(4);
        $data['new_products'] = $productModel->getNewProducts(4);
        $data['categories']  = $categoryModel->getAll();

        require ROOT . '/app/views/home/index.php';
    }
}
