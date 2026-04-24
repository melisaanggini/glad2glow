<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glad2Glow — Glowing Skin Starts Here</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/home.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/category.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/product.css">
</head>
<body>

<header class="header">
    <div class="container header-wrapper">

        <!-- LOGO -->
        <a href="<?= BASEURL ?>" class="logo">
            <img src="<?= BASEURL ?>/assets/images/logo.png" alt="Glad2Glow">
        </a>

        <!-- NAVIGATION (E3: Kepraktisan Navigasi) -->
        <nav class="nav">
            <a href="<?= BASEURL ?>" class="<?= ($_SERVER['REQUEST_URI'] === '/glad2glow/public' || $_SERVER['REQUEST_URI'] === '/glad2glow/public/') ? 'active' : '' ?>">Home</a>
            <a href="<?= BASEURL ?>/category" class="<?= (strpos($_SERVER['REQUEST_URI'], '/category') !== false) ? 'active' : '' ?>">Shop</a>
            <a href="#">About</a>
        </nav>

        <!-- RIGHT ACTIONS -->
        <div class="header-right">
            <!-- SEARCH (E1: Kecepatan Menemukan Informasi) -->
            <div class="search-box">
                <input type="text" placeholder="Cari produk...">
                <img src="<?= BASEURL ?>/assets/icons/icon_search.png" alt="Search" class="search-icon">
            </div>

            <!-- CURRENCY -->
            <select class="currency">
                <option>United States (USD $)</option>
                <option>Australia (AUD A$)</option>
                <option>Austria (EUR €)</option>
                <option>Belgium (EUR €)</option>
                <option>Brasil (BRL R$)</option>
                <option>Canada (CAD C$)</option>
                <option>Egypt (EGP £)</option>
                <option>France (EUR €)</option>
                <option>Germany (EUR €)</option>
            </select>

            <!-- ICONS -->
            <div class="header-icons">
                <button class="icon-btn" title="Wishlist">
                    <img src="<?= BASEURL ?>/assets/icons/icon_email.png" alt="Email">
                </button>

                <button class="icon-btn" title="Akun">
                    <img src="<?= BASEURL ?>/assets/icons/icon_user.png" alt="User">
                </button>

                <button class="icon-btn" title="Keranjang" style="position:relative">
                    <img src="<?= BASEURL ?>/assets/icons/icon_cart.png" alt="Cart">
                    <span class="cart-badge">0</span>
                </button>
            </div>
        </div>

    </div>
</header>
