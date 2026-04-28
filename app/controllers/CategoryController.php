<?php
require_once ROOT . '/app/models/Category.php';
require_once ROOT . '/app/models/Product.php';

class CategoryController {
    public function index() {

        $categoryModel = new Category();
        $productModel  = new Product();

        $data['categories'] = $categoryModel->getAll();

        $order = [
            'Make Up' => 1,
            'Cleanser' => 2,
            'Serum' => 3,
            'Toner' => 4,
            'Moisturizer' => 5,
            'Body Lotion' => 6,
            'Combo Sets' => 7
        ];

        usort($data['categories'], function ($a, $b) use ($order) {
            return ($order[$a['name']] ?? 999) <=> ($order[$b['name']] ?? 999);
        });

        $data['selected_category'] = null;
        $data['products']          = [];
        $data['active_filter']     = null;

        if (!empty($_GET['cat'])) {

            $cat = $_GET['cat'];

            //  BEST SELLER 
            if ($cat === 'bestseller') {

                $data['active_filter'] = 'bestseller';
                $data['selected_category'] = [
                    'name' => 'Best Seller',
                    'id'   => 'bestseller'
                ];

                $data['products'] = $productModel->getBestsellers(12);

            } 
            //  CATEGORY ID 
            else {

                $catId = (int) $cat;

                if ($catId > 0) {

                    $data['active_filter'] = $catId;
                    $data['selected_category'] = $categoryModel->getById($catId);

                    $data['products'] = $productModel->getByCategory($catId);
                }
            }
        }

        if (empty($data['products'])) {
            $data['products'] = $productModel->getAll();
        }

        require ROOT . '/app/views/category/index.php';
    }
}