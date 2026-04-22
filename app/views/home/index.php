<?php require ROOT . '/app/views/layouts/header.php'; ?>

<!-- ===========================
     HERO SECTION
     =========================== -->
<section class="hero">
    <div class="container">

        <!-- HERO WRAPPER -->
        <div class="hero-wrapper">

            <!-- BACKGROUND IMAGE -->
            <div class="hero-image">
                <img src="<?= BASEURL ?>/assets/images/hero.png" alt="Hero">
            </div>

            <!-- TEXT CONTENT -->
            <div class="hero-text">
                <p class="hero-eyebrow">New — 2026 Exfoliation Collection</p>

                <h1 class="hero-title">
                    Glowing Skin <br>
                    Starts with the Right Care
                </h1>

                <p class="hero-desc">
                    Selected skincare products, formulated for tropical skin.
                    Suitable for all skin types.
                </p>

                <a href="<?= BASEURL ?>/category" class="btn-primary">
                    Shop Now
                </a>
            </div>

        </div>

    </div>
</section>


<!-- ===========================
     CATEGORY PRODUCT
     =========================== -->
<section class="section-categories">
    <div class="container">

        <h2 class="section-title">Category Product</h2>

        <div class="category-grid-home">

            <?php
            $categories = [
                ['makeup.png','Make Up'],
                ['micellar.png','Cleanser'],
                ['serum.png','Serum'],
                ['toner.png','Toner'],
                ['moisturizer.png','Moisturizer'],
                ['lotion.png','Body Lotion'],
                ['combo.png','Combo Sets'],
            ];
            foreach ($categories as $cat):
            ?>
            <div class="category-card-home">
                <img src="<?= BASEURL ?>/assets/images/<?= $cat[0] ?>" alt="<?= $cat[1] ?>">
                <span><?= $cat[1] ?></span>
            </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>


<!-- ===========================
     BEST SELLER
     =========================== -->
<section class="section-bestseller">
    <div class="container">

        <h2 class="section-title">Best Seller</h2>

        <div class="product-grid">

            <?php if (!empty($data['bestsellers'])): ?>
                <?php foreach ($data['bestsellers'] as $product): ?>
                <div class="product-card">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>">
                    </div>

                    <div class="product-card-body">
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>

                        <div class="product-rating">
                            ⭐ <?= number_format($product['rating'] ?? 4.5, 1) ?>
                        </div>

                        <div class="product-price">
                            <span class="price-new">
                                Rp <?= number_format($product['price'] ?? 20000, 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>

                    <div class="product-card-footer">
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-primary">
                            Shop Now
                        </a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Produk belum tersedia</p>
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

        <div class="product-grid">

            <?php if (!empty($data['new_products'])): ?>
                <?php foreach ($data['new_products'] as $product): ?>
                <div class="product-card large">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>">
                    </div>

                    <div class="product-card-body center">
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>

                        <p class="price-new">
                            Rp <?= number_format($product['price'] ?? 40000, 0, ',', '.') ?>
                        </p>

                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-secondary">
                            View More
                        </a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Produk baru akan segera hadir</p>
            <?php endif; ?>

        </div>

    </div>
</section>


<?php require ROOT . '/app/views/layouts/footer.php'; ?>