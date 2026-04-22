<?php require ROOT . '/app/views/layouts/header.php'; ?>

<!-- PAGE BANNER (E1: F-Pattern — judul langsung terlihat) -->
<section class="page-banner">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= BASEURL ?>">Home</a>
            <span>›</span>
            <span>Shop</span>
            <?php if (!empty($data['selected_category'])): ?>
            <span>›</span>
            <span><?= htmlspecialchars($data['selected_category']['name']) ?></span>
            <?php endif; ?>
        </div>
        <h1>Shop by Category</h1>
        <p>Temukan produk skincare terbaik sesuai kebutuhanmu</p>
    </div>
</section>

<section class="category-page-content">
    <div class="container">

        <!-- CATEGORY FILTER (C1: Pengelompokan jelas, E3: Recognition > Recall) -->
        <?php
        $icons = ['Skincare'=>'💧','Body Care'=>'🧴','Hair Care'=>'💆','Lip Care'=>'💋','Sun Care'=>'☀️','Eye Care'=>'👁️'];
        $selectedCatId = isset($_GET['cat']) ? (int)$_GET['cat'] : null;
        ?>

        <div class="category-list-grid">
            <a href="<?= BASEURL ?>/category" class="category-filter-card <?= !$selectedCatId ? 'active' : '' ?>">
                <span class="cat-icon">🌿</span>
                <span>Semua</span>
            </a>
            <?php foreach ($data['categories'] as $cat): ?>
            <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>"
               class="category-filter-card <?= ($selectedCatId == $cat['id']) ? 'active' : '' ?>">
                <span class="cat-icon"><?= $icons[$cat['name']] ?? '🧪' ?></span>
                <span><?= htmlspecialchars($cat['name']) ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- PRODUCTS LISTING (C4: Grid terstruktur, QC1: Info produk lengkap) -->
        <div class="category-products-section">
            <div class="category-products-header">
                <h2>
                    <?php if (!empty($data['selected_category'])): ?>
                        <?= htmlspecialchars($data['selected_category']['name']) ?>
                    <?php else: ?>
                        Semua Produk
                    <?php endif; ?>
                </h2>
                <?php if (!empty($data['products'])): ?>
                <p style="margin-top:4px;"><?= count($data['products']) ?> produk ditemukan</p>
                <?php endif; ?>
            </div>

            <?php if ($selectedCatId && !empty($data['products'])): ?>
            <div class="products-grid">
                <?php foreach ($data['products'] as $product): ?>
                <div class="product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                        <?php if ($product['is_bestseller']): ?><span class="badge">Best Seller</span><?php endif; ?>
                        <?php if ($product['is_new']): ?><span class="badge new" style="top:10px;left:<?= $product['is_bestseller'] ? '90px' : '10px' ?>">New</span><?php endif; ?>
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
            </div>

            <?php elseif ($selectedCatId): ?>
                <div class="empty-state">
                    <p>Belum ada produk di kategori ini</p>
                </div>

            <?php else: ?>
                <!-- Tampilkan semua kategori dengan gambar (saat belum dipilih) -->
                <div class="products-grid">
                    <?php
                    $catImages = ['Skincare'=>'💧','Body Care'=>'🧴','Hair Care'=>'💆','Lip Care'=>'💋','Sun Care'=>'☀️','Eye Care'=>'👁️'];
                    foreach ($data['categories'] as $cat):
                    ?>
                    <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>"
                       style="display:block; background:#fff; border:1px solid var(--border); border-radius:10px; overflow:hidden; transition:0.25s ease; text-decoration:none; color:inherit;">
                        <div style="aspect-ratio:4/3; background:var(--pink-light); display:flex; align-items:center; justify-content:center; font-size:60px;">
                            <?= $catImages[$cat['name']] ?? '🌿' ?>
                        </div>
                        <div style="padding:16px;">
                            <h3 style="font-size:16px; margin-bottom:4px;"><?= htmlspecialchars($cat['name']) ?></h3>
                            <p style="font-size:13px; color:var(--pink);">Lihat Produk →</p>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>

<?php require ROOT . '/app/views/layouts/footer.php'; ?>
