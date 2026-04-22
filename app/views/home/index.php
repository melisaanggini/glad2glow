<?php require ROOT . '/app/views/layouts/header.php'; ?>

<!-- Hero Section-->
<section class="hero">
    <div class="container hero-wrapper">

        <div class="hero-text">
            <div class="hero-eyebrow">✨ New — 2026 Exfoliation Collection</div>
            <h1 class="hero-title">
                Glowing Skin <br>
                <span>Starts with the Right Care</span>
            </h1>
            <p class="hero-desc">
                Produk skincare pilihan, diformulasikan khusus untuk kulit tropis. 
                Cocok untuk semua jenis kulit — hasilnya nyata dari hari pertama.
            </p>
            <div class="hero-actions">
                <a href="<?= BASEURL ?>/category" class="btn-primary">Shop Now</a>
                <a href="#bestseller" class="btn-secondary">Lihat Best Seller</a>
            </div>
            <div class="hero-trust">
                <div class="trust-item">⭐ Rating 4.8/5</div>
                <div class="trust-divider"></div>
                <div class="trust-item">🚚 Free Ongkir > 150rb</div>
                <div class="trust-divider"></div>
                <div class="trust-item">✅ BPOM Certified</div>
            </div>
        </div>

        <div class="hero-image">
            <img src="<?= BASEURL ?>/assets/images/Hero.png" alt="Glad2Glow Hero">
        </div>

    </div>
</section>

<!-- ===========================
     CATEGORY NAVIGATION
     E3: Navigasi berbasis ikon (Recognition > Recall)
     C1: Pengelompokan jelas
     =========================== -->
<section class="section-categories">
    <div class="container">

        <div class="section-header">
            <h2>Kategori Produk</h2>
            <a href="<?= BASEURL ?>/category">Lihat Semua →</a>
        </div>

        <div class="category-grid-home">
            <?php
            // Icon mapping per category
            $icons = ['Skincare'=>'💧','Body Care'=>'🧴','Hair Care'=>'💆','Lip Care'=>'💋','Sun Care'=>'☀️','Eye Care'=>'👁️'];
            if (!empty($data['categories'])):
                foreach ($data['categories'] as $cat):
                    $icon = $icons[$cat['name']] ?? '🌿';
            ?>
            <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>" class="category-card-home">
                <div class="category-icon"><?= $icon ?></div>
                <span><?= htmlspecialchars($cat['name']) ?></span>
            </a>
            <?php endforeach; else: ?>
            <p>Kategori tidak ditemukan</p>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- ===========================
     BEST SELLER SECTION
     QC1: Card produk lengkap (nama, varian, ukuran, harga, rating)
     C4: Grid layout seimbang
     =========================== -->
<section class="section-bestseller" id="bestseller">
    <div class="container">

        <div class="section-header">
            <h2>🔥 Best Seller</h2>
            <a href="<?= BASEURL ?>/category">Lihat Semua →</a>
        </div>

        <div class="product-grid">
            <?php if (!empty($data['bestsellers'])): ?>
                <?php foreach ($data['bestsellers'] as $product): ?>
                <div class="product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                        <span class="badge">Best Seller</span>
                    </div>

                    <div class="product-card-body">
                        <p class="product-cat"><?= htmlspecialchars($product['category_name'] ?? '') ?></p>
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                        <?php if (!empty($product['variant'])): ?>
                        <p class="product-variant"><?= htmlspecialchars($product['variant']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($product['size'])): ?>
                        <p class="product-size"><?= htmlspecialchars($product['size']) ?></p>
                        <?php endif; ?>
                        <div class="product-rating">
                            <span class="stars">★★★★★</span>
                            <span style="font-size:12px; font-weight:600;"><?= number_format($product['rating'], 1) ?></span>
                            <span class="rating-count">(<?= number_format($product['review_count']) ?>)</span>
                        </div>
                        <div class="product-price-row">
                            <span class="price-new">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                            <?php if (!empty($product['old_price'])): ?>
                            <span class="price-old">Rp <?= number_format($product['old_price'], 0, ',', '.') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="product-card-footer">
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-primary">Shop Now</a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state"><p>Produk tidak tersedia saat ini</p></div>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- ===========================
     NEW PRODUCT SECTION
     =========================== -->
<section class="section-new">
    <div class="container">

        <div class="section-header">
            <h2>✨ Produk Terbaru</h2>
            <a href="<?= BASEURL ?>/category">Lihat Semua →</a>
        </div>

        <div class="product-grid">
            <?php if (!empty($data['new_products'])): ?>
                <?php foreach ($data['new_products'] as $product): ?>
                <div class="product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                        <span class="badge new">New</span>
                    </div>

                    <div class="product-card-body">
                        <p class="product-cat"><?= htmlspecialchars($product['category_name'] ?? '') ?></p>
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                        <?php if (!empty($product['variant'])): ?>
                        <p class="product-variant"><?= htmlspecialchars($product['variant']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($product['size'])): ?>
                        <p class="product-size"><?= htmlspecialchars($product['size']) ?></p>
                        <?php endif; ?>
                        <div class="product-rating">
                            <span class="stars">★★★★★</span>
                            <span style="font-size:12px; font-weight:600;"><?= number_format($product['rating'], 1) ?></span>
                            <span class="rating-count">(<?= number_format($product['review_count']) ?>)</span>
                        </div>
                        <div class="product-price-row">
                            <span class="price-new">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                            <?php if (!empty($product['old_price'])): ?>
                            <span class="price-old">Rp <?= number_format($product['old_price'], 0, ',', '.') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="product-card-footer">
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-secondary">View Detail</a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state"><p>Produk baru akan segera hadir</p></div>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- PROMO BANNER -->
<section class="section-promo">
    <div class="container promo-wrapper">
        <div class="promo-text">
            <h2>Gratis Ongkir untuk Pembelian Pertama!</h2>
            <p>Gunakan kode <strong style="color:var(--pink)">GLOW10</strong> untuk diskon 10% + gratis ongkir ke seluruh Indonesia</p>
            <a href="<?= BASEURL ?>/category" class="btn-primary">Belanja Sekarang</a>
        </div>
        <div class="promo-image">
            <img src="<?= BASEURL ?>/assets/images/promo-banner.jpg" alt="Promo" onerror="this.style.display='none'">
        </div>
    </div>
</section>

<?php require ROOT . '/app/views/layouts/footer.php'; ?>
