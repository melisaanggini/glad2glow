<?php
require_once '../app/controllers/ProductController.php';

$controller = new ProductController();

if (isset($_GET['category'])) {
    $controller->category($_GET['category']);
} else {
    $controller->home();
}
?>