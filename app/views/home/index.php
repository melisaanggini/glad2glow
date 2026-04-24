<?php
$pageTitle = 'Glad2Glow — Glowing Skin Starts Here';
$pageCSS   = 'home.css';
require ROOT . '/app/views/layouts/header.php';
?>

<!-- HERO SECTION -->
    <section class="hero-section">
    <div class="container">
        <div class="hero-wrapper">
            <img src="<?= BASEURL ?>/assets/images/Hero.png" alt="Hero" class="hero-img">
                
            <a href="<?= BASEURL ?>/category" class="btn-hero">
                Shop Now
            </a>
        </div>
    </div>
</section>


<!-- ===========================
     CATEGORY PRODUCT
     C1: Pengelompokan ikon, E3: Recognition > Recall
     =========================== -->
<section class="section-categories">
    <div class="container">

        <h2 style="text-align:center; font-size:26px; font-weight:600; margin-bottom:36px;">
            Category Product
        </h2>
        <div class="category-grid-home">
            <?php
            // Mapping kategori → gambar (sesuai file yang ada)
            $catImages = [
                'Make Up'     => 'makeup.png',
                'Cleanser'    => 'micellar.png',
                'Serum'       => 'serum.png',
                'Toner'       => 'toner.png',
                'Moisturizer' => 'moisturizer.png',
                'Body Lotion' => 'lotion.png',
                'Combo Sets'  => 'combo.png',
            ];

            if (!empty($data['categories'])):
                foreach ($data['categories'] as $cat):
                    $imgFile = $catImages[$cat['name']] ?? 'placeholder.jpg';
            ?>
            <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>" class="category-card-home">
                <img src="<?= BASEURL ?>/assets/images/<?= $imgFile ?>" alt="<?= htmlspecialchars($cat['name']) ?>">
                <span><?= htmlspecialchars($cat['name']) ?></span>
            </a>
            <?php endforeach; endif; ?>
        </div>

    </div>
</section>


<!-- ===========================
     BEST SELLER
     QC1: Kartu produk lengkap (nama, harga lama/baru, rating, review)
     =========================== -->
<section class="section-bestseller">
    <div class="container">

        <h2 style="text-align:center; font-size:26px; font-weight:600; margin-bottom:36px;">
            Best Seller
        </h2>

        <div class="product-grid">
            <?php if (!empty($data['bestsellers'])): ?>
                <?php foreach ($data['bestsellers'] as $product): ?>
                <div class="product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                    </div>

                    <div class="product-card-body">
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>

                        <div class="product-price-row">
                            <span class="price-new">$<?= number_format($product['price'], 0) ?></span>
                            <?php if (!empty($product['old_price'])): ?>
                            <span class="price-old">$<?= number_format($product['old_price'], 0) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="product-rating">
                            <span class="stars">★</span>
                            <span><?= number_format($product['rating'], 1) ?></span>
                            <span class="rating-count"><?= $product['review_count'] ?> review</span>
                        </div>
                    </div>

                    <div class="product-card-footer">
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-shop-now">Shop Now</a>
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-cart-icon">
                            <img src="<?= BASEURL ?>/assets/icons/icon_cart.png" alt="cart">
                        </a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color:#999; grid-column:1/-1; text-align:center; padding:40px 0;">Produk belum tersedia</p>
            <?php endif; ?>
        </div>

    </div>
</section>


<!-- ===========================
     NEW PRODUCT
     =========================== -->
<section class="section-new">
    <div class="container">

        <h2 class="section-title">New Product</h2>

        <div class="product-grid product-grid-new">
            <?php if (!empty($data['new_products'])): ?>
                <?php foreach ($data['new_products'] as $product): ?>
                <div class="product-card product-card-new" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                    </div>

                    <div class="product-card-body center">
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="price-new">$<?= number_format($product['price'], 0) ?></p>
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-view-more">View More</a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color:#999; grid-column:1/-1; text-align:center; padding:40px 0;">Produk baru akan segera hadir</p>
            <?php endif; ?>
        </div>

    </div>
</section>


<?php require ROOT . '/app/views/layouts/footer.php'; ?>