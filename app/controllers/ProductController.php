<?php
require_once ROOT . '/app/models/Product.php';
require_once ROOT . '/app/models/Category.php';

class ProductController {
    public function index() {
        $productModel = new Product();
        $data['products'] = $productModel->getAll();
        require ROOT . '/app/views/product/index.php';
    }

    public function detail($id) {
        $productModel  = new Product();
        $categoryModel = new Category();

        $data['product'] = $productModel->getById($id);
        if (!$data['product']) {
            http_response_code(404);
            echo "<h1>Produk tidak ditemukan</h1><a href='" . BASEURL . "'>Kembali ke Beranda</a>";
            return;
        }

        $data['related'] = $productModel->getRelated($data['product']['category_id'], $id, 4);
        $data['category'] = $categoryModel->getById($data['product']['category_id']);

        require ROOT . '/app/views/product/detail.php';
    }
}
