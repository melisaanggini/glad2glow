<?php require ROOT . '/app/views/layouts/header.php'; ?>

<?php
$categoryIcons = [
    'Best Seller' => 'best-seller.png',
    'Make Up' => 'makeup.png',
    'Cleanser' => 'micellar.png',
    'Serum' => 'serum.png',
    'Toner' => 'toner.png',
    'Moisturizer' => 'moisturizer.png',
    'Body Lotion' => 'lotion.png',
    'Combo Sets' => 'combo.png',
];

$selectedCatId = isset($_GET['cat']) ? (int)$_GET['cat'] : null;
?>

<!-- ===========================
     HERO STRIP
     =========================== -->
<section class="category-hero">
    <div class="container">
        <h2>Find the Best Skincare Routine for Your Skin</h2>
    </div>
</section>


<!-- ===========================
     CATEGORY + PRODUCT
     =========================== -->
<section class="category-page">
    <div class="container">

        <!-- ================= CATEGORY HORIZONTAL ================= -->
        <div class="category-horizontal">

            
            <?php foreach ($data['categories'] as $cat): ?>
            <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>"
               class="category-item <?= ($selectedCatId == $cat['id']) ? 'active' : '' ?>">

                <img src="<?= BASEURL ?>/assets/images/<?= $categoryIcons[$cat['name']] ?? 'default.png' ?>">
                <p><?= htmlspecialchars($cat['name']) ?></p>

            </a>
            <?php endforeach; ?>

        </div>


        <!-- ================= PRODUCT GRID ================= -->
        <?php if (!empty($data['products'])): ?>

        <div class="product-grid">

            <?php foreach ($data['products'] as $product): ?>
            <div class="product-card">

                <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>">

                <h4><?= htmlspecialchars($product['name']) ?></h4>

                <div class="price">
                    <span class="new">
                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                    </span>

                    <?php if (!empty($product['old_price'])): ?>
                        <span class="old">
                            Rp <?= number_format($product['old_price'], 0, ',', '.') ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="rating">
                    ⭐ <?= number_format($product['rating'] ?? 4.5, 1) ?>
                    <span><?= $product['review_count'] ?? 0 ?> review</span>
                </div>

                <div class="btn-row">
                    <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-shop">
                        Shop Now
                    </a>

                    <button class="btn-cart">🛒</button>
                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <?php else: ?>

            <div class="empty-state">
                <p>Produk belum tersedia</p>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php require ROOT . '/app/views/layouts/footer.php'; ?>