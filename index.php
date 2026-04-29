<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASEURL', 'http://localhost/glad2glow');

define('ROOT', __DIR__);

$request = $_SERVER['REQUEST_URI'];

$path = strtok($request, '?');

$basePath = '/glad2glow';
$path = str_replace($basePath, '', $path);

$path = rtrim($path, '/');
if ($path === '') $path = '/';

switch ($path) {
    case '/':
    case '/home':
        require_once ROOT . '/app/controllers/HomeController.php';
        $ctrl = new HomeController();
        $ctrl->index();
        break;

    case '/category':
    case '/shop':
        require_once ROOT . '/app/controllers/CategoryController.php';
        $ctrl = new CategoryController();
        $ctrl->index();
        break;

    case '/product':
        require_once ROOT . '/app/controllers/ProductController.php';
        $ctrl = new ProductController();

        if (isset($_GET['id'])) {
            $ctrl->detail($_GET['id']);
        } else {
            $ctrl->index();
        }
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Halaman tidak ditemukan</h1>
              <a href='" . BASEURL . "'>Kembali ke Beranda</a>";
        break;
}